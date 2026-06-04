<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Transaksi;
use Midtrans\Config;
use Midtrans\Snap;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        $tipes = \App\Models\Tipe::all();
        $query = Mobil::with('tipe')->latest();

        if ($request->filled('search')) {
            $query->where('nama_mobil', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('tipe_id', $request->kategori);
        }

        $mobils = $query->get();

        return view('frontend.index', compact('mobils', 'tipes'));
    }

    public function show($id)
    {
        $mobil = Mobil::with('tipe')->findOrFail($id);
        return view('frontend.detail', ['mobil' => $mobil]);
    }

    public function booking($id)
    {
        $mobil = Mobil::findOrFail($id);
        return view('frontend.booking', compact('mobil'));
    }

    public function bookingStore(Request $request)
    {
        $request->validate([
            'mobil_id'          => 'required',
            'no_hp'             => 'required|string|max:15',
            'alamat_pengiriman' => 'required',
        ]);

        // Hapus transaksi Pending lama milik user untuk mobil yang sama
        Transaksi::where('user_id', auth()->id())
            ->where('mobil_id', $request->mobil_id)
            ->where('status', 'Pending')
            ->delete();

        $transaksi = Transaksi::create([
            'user_id'           => auth()->id(),
            'mobil_id'          => $request->mobil_id,
            'kode_booking'      => 'BKG-' . strtoupper(uniqid()),
            'no_hp'             => $request->no_hp,
            'alamat_pengiriman' => $request->alamat_pengiriman,
            'booking_fee'       => 5000000,
            'bukti_bayar'       => '-',
            'status'            => 'Pending',
        ]);

        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized  = config('services.midtrans.is_sanitized');
        Config::$is3ds        = config('services.midtrans.is_3ds');

        $params = [
            'transaction_details' => [
                'order_id'     => $transaksi->kode_booking,
                'gross_amount' => 5000000,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->nama,
                'email'      => auth()->user()->email,
                'phone'      => $request->no_hp,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('frontend.pembayaran', compact('snapToken', 'transaksi'));
    }

    public function bookingCancel($kodeBooking)
    {
        $transaksi = Transaksi::where('kode_booking', $kodeBooking)
            ->where('user_id', auth()->id())
            ->where('status', 'Pending')
            ->first();

        if ($transaksi) {
            $transaksi->delete();
        }

        return redirect()->route('beranda')  // FIX: was 'frontend.index'
            ->with('info', 'Pemesanan dibatalkan.');
    }

    public function pesananSaya()
    {
        $pesanan = \App\Models\Transaksi::with('mobil')
            ->where('user_id', auth()->user()->id)
            ->latest()
            ->get();

        return view('frontend.pesanan_saya', compact('pesanan'));
    }

    public function profil()
    {
        return view('frontend.profil');
    }

    public function profilUpdate(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
        ]);

        $user = \App\Models\User::find(auth()->id());
        $user->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
