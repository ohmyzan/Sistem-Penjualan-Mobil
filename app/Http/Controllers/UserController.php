<!-- untuk bagian mengisi dan menyimpan data--> 
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function create()
{
    return view('backend.v_user.create', [
        'judul' => 'Tambah User'
    ]);
}

public function store(Request $request)
{
    // Validasi input
    $validatedData = $request->validate([
        'nama'   => 'required|max:255',
        'email'  => 'required|email|unique:user,email',
        'no_hp'  => 'required|min:10|max:13',
        'alamat' => 'required',
        'role'   => 'required',
        'password' => 'required|min:6'
    ]);

    // Simpan data
    User::create([
        'nama' => $request->nama,
        'email' => $request->email,
        'role' => $request->role,
        'status' => 1,
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
        'password' => bcrypt($request->password),
    ]);

    // Setelah simpan, kembali ke halaman index
    return redirect()->route('backend.user.index');
}
}
