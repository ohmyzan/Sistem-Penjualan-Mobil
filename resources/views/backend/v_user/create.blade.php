<!-- untuk bagian kalo menambahkan data--> 
@extends('backend.v_layouts.app')
@section('content')

<h3>{{ $judul }}</h3>

<form action="{{ route('backend.user.store') }}" method="post">
    @csrf

    <label>Nama</label><br>
    <input type="text" name="nama" id="" value="{{ old('nama') }}" 
           placeholder="Masukkan Nama Lengkap" 
           class="form-control @error('nama') is-invalid @enderror">
    @error('nama')
        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
    @enderror
    <p></p>

    <label>Email</label><br>
    <input type="email" name="email" id="" value="{{ old('email') }}" 
           placeholder="Masukkan Email"
           class="form-control @error('email') is-invalid @enderror">
    @error('email')
        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
    @enderror
    <p></p>

    <label>NO_HP</label><br>
    <input type="text" name="no_hp" id="" value="{{ old('no_hp') }}" 
           placeholder="Masukkan Nomor HP" 
           class="form-control @error('no_hp') is-invalid @enderror">
    @error('no_hp')
        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
    @enderror
    <p></p>

    <label>Alamat</label><br>
    <textarea name="alamat" id="" placeholder="Masukkan Alamat" 
              class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
    @error('alamat')
        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
    @enderror
    <p></p>

    <label>Role</label><br>
<select name="role" class="form-control @error('role') is-invalid @enderror">
    <option value="">-- Pilih Role --</option>

    <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>1. SuperAdmin</option>
    <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>0. Admin</option>
    <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>2. Customer/User</option>

</select>
@error('role')
    <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
@enderror
<p></p>


    <label>Password</label><br>
    <input type="password" name="password" id="" 
           placeholder="Masukkan Password" 
           class="form-control @error('password') is-invalid @enderror">
    @error('password')
        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
    @enderror
    <p></p>

    <button type="button" onclick="window.location='{{ route('backend.user.index') }}'">
    Batal
    </button>

    <button type="submit">Simpan</button>
    <a href="{{ route('backend.user.index') }}">
    </a>
</form>

@endsection
