<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $query = User::orderByRaw("
            CASE 
                WHEN role = 1 THEN 1   -- Super Admin
                WHEN role = 0 THEN 2   -- Admin
                WHEN role = 2 THEN 3   -- User
                ELSE 4
            END
        ")->orderBy('id', 'desc');


    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->search . '%')
              ->orWhere('no_hp', 'like', '%' . $request->search . '%');
        });
    }

    $index = $query->paginate(10)->withQueryString();

    return view('backend.v_user.index', [
        'judul' => 'Data User',
        'index' => $index
    ]);
}

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [ 
            'judul' => 'Tambah User' 
        ]); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama'     => 'required|max:255',
            'email'    => 'required|email|unique:user,email', // sesuaikan 'user' jika tabel lo 'users'
            'no_hp'    => 'required|min:10|max:13',
            'alamat'   => 'required',
            'role'     => 'required',
            'password' => 'required|min:6'
        ]);

        // Simpan data
        User::create([
            'nama'     => $validatedData['nama'],
            'email'    => $validatedData['email'],
            'role'     => $validatedData['role'],
            'status'   => 1,
            'no_hp'    => $validatedData['no_hp'],
            'alamat'   => $validatedData['alamat'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Setelah simpan, kembali ke halaman index (route name sesuai resource as => 'backend')
        return redirect()->route('backend.user.index')->with('success', 'Data user berhasil ditambahkan'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         // Optional: implement jika perlu
        $user = User::findOrFail($id);
        return view('backend.v_user.show', [
            'judul' => 'Detail User',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
          $user = User::findOrFail($id); 
        return view('backend.v_user.edit', [ 
            'judul' => 'Ubah User', 
            'edit' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $rules = [
        'nama'   => 'required|string|max:255',
        'email'  => "required|email|unique:user,email,{$id},id", // pakai 'users' kalau tabel plural
        'no_hp'  => 'required|min:10|max:13',
        'alamat' => 'nullable|string',
        'role'   => 'required|in:0,1,2',
        'password' => 'nullable|min:6'
    ];

    $validated = $request->validate($rules);

    // kalau password kosong, hapus dari array agar tidak menimpa field di DB
    if (empty($validated['password'])) {
        unset($validated['password']);
    } else {
        $validated['password'] = bcrypt($validated['password']);
    }

    User::where('id', $id)->update($validated);

    return redirect()->route('backend.user.index')->with('success', 'Data user berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $user = User::findOrFail($id);
    $user->delete();

    return redirect(to: '/backend/user')->with('success', 'Data user berhasil dihapus');
    }

}
