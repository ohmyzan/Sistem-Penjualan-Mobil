<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil; 

class MobilController extends Controller
{
    // Tampilkan daftar mobil
  public function index(Request $request)
{
    $query = Mobil::orderBy('id', 'desc');

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama_mobil', 'like', '%' . $request->search . '%')
              ->orWhere('brand', 'like', '%' . $request->search . '%');
        });
    }

    $index = $query->paginate(10)->withQueryString();

    return view('backend.v_mobil.index', [
        'judul' => 'Data Mobil',
        'index' => $index
    ]);
}

    // Form tambah mobil
    public function create()
    {
        return view('backend.v_mobil.create', [ 
            'judul' => 'Tambah Mobil' 
        ]); 
    }

    // Simpan data baru
    public function store(Request $request)
    {
       $validatedData = $request->validate([
        'nama_mobil' => 'required|max:255',
        'brand'      => 'required|max:100',
        'tahun'      => 'required|digits:4',
        'stok'       => 'required|integer|min:0',
        'warna'      => 'required|max:50',
        'harga'      => 'required|integer|min:0',
        'kapasitas'  => 'required|integer|min:1',
    ]);

    Mobil::create($validatedData);

    return redirect()->route('backend.mobil.index')
                     ->with('success', 'Data mobil berhasil ditambahkan');
    }

    // Form edit mobil
    public function edit(string $id)
    {
        $mobil = Mobil::findOrFail($id);

        // ⚡ Perbaikan: path view sesuai folder backend
        return view('backend.v_mobil.edit', [
            'judul' => 'Ubah Data Mobil',
            'edit'  => $mobil
        ]);
    }

    // Update data mobil
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_mobil' => 'required|max:255',
            'brand'      => 'required|max:255',
            'tahun'      => 'required|integer',
            'stok'       => 'required|integer',
        ]);

        Mobil::where('id', $id)->update($validatedData);

        // ⚡ Perbaikan: route sesuai prefix backend
        return redirect()->route('backend.mobil.index')
                         ->with('success', 'Data mobil berhasil diubah');
    }

    // Hapus mobil
    public function destroy(string $id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->delete();

        // ⚡ Perbaikan: route sesuai prefix backend
        return redirect()->route('backend.mobil.index')
                         ->with('success', 'Data mobil berhasil dihapus');
    }
}
