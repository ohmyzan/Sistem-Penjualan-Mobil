<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    /**
     * TAMPILKAN DATA MERK
     */
    public function index(Request $request)
    {
        $query = Merk::orderBy('id', 'desc');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_merk', 'like', '%' . $request->search . '%')
                  ->orWhere('negara_asal', 'like', '%' . $request->search . '%');
            });
        }

        $index = $query->paginate(10)->withQueryString();

        return view('backend.v_merk.index', [
            'judul' => 'Data Merk',
            'index' => $index
        ]);
    }

    /**
     * TAMPILKAN FORM TAMBAH MERK
     */
    public function create()
    {
        return view('backend.v_merk.create', [
            'judul' => 'Tambah Merk Mobil'
        ]);
    }

    /**
     * SIMPAN DATA MERK
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_merk'   => 'required|string|max:100',
            'negara_asal' => 'required|string|max:100',
        ]);

        Merk::create([
            'nama_merk'   => $request->nama_merk,
            'negara_asal' => $request->negara_asal,
        ]);

        return redirect()
            ->route('backend.merk.index')
            ->with('success', 'Data merk berhasil ditambahkan!');
    }

    /**
     * TAMPILKAN FORM EDIT
     */
    public function edit($id)
    {
        return view('backend.v_merk.edit', [
            'judul' => 'Edit Merk Mobil',
            'merk'  => Merk::findOrFail($id)
        ]);
    }

    /**
     * UPDATE DATA MERK
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_merk'   => 'required|string|max:100',
            'negara_asal' => 'required|string|max:100',
        ]);

        $merk = Merk::findOrFail($id);
        $merk->update([
            'nama_merk'   => $request->nama_merk,
            'negara_asal' => $request->negara_asal,
        ]);

        return redirect()
            ->route('backend.merk.index')
            ->with('success', 'Data merk berhasil diperbarui!');
    }

    /**
     * HAPUS DATA MERK
     */
    public function destroy($id)
    {
        Merk::findOrFail($id)->delete();

        return redirect()
            ->route('backend.merk.index')
            ->with('success', 'Data merk berhasil dihapus!');
    }
}
