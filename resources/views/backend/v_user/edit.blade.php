<!-- untuk bagian ubah data atau edit--> 
@extends('backend.v_layouts.app')

@section('content')

<style>
    .card-custom {
        background: #ffffff;
        border-radius: 14px;
        padding: 25px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.15);
        border-left: 5px solid #003B73;
    }

    .btn-primary-custom {
        background-color: #003B73;
        color: white;
        border-radius: 8px;
        padding: 8px 18px;
        border: none;
    }
    .btn-primary-custom:hover {
        background-color: #002855;
    }

    .btn-secondary-custom {
        background-color: #6c757d;
        color: white;
        border-radius: 8px;
        padding: 8px 18px;
        border: none;
    }

    label {
        font-weight: 600;
    }
</style>


<div class="card-custom">

    <h3 class="mb-3">{{ $judul }}</h3>

    <form action="{{ route('backend.user.update', $edit->id) }}" method="post">
        @method('put')
        @csrf

        {{-- NAMA --}}
        <label>Nama</label>
        <input type="text" name="nama" 
               value="{{ old('nama', $edit->nama) }}"
               class="form-control mb-3 @error('nama') is-invalid @enderror"
               placeholder="Masukkan Nama Lengkap">
        @error('nama')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- EMAIL --}}
        <label>Email</label>
        <input type="email" name="email" 
               value="{{ old('email', $edit->email) }}"
               class="form-control mb-3 @error('email') is-invalid @enderror"
               placeholder="Masukkan Email">
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- NO HP --}}
        <label>NO HP</label>
        <input type="text" name="no_hp" 
               value="{{ old('no_hp', $edit->no_hp) }}"
               class="form-control mb-3 @error('no_hp') is-invalid @enderror"
               placeholder="Masukkan Nomor HP">
        @error('no_hp')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- ALAMAT --}}
        <label>Alamat</label>
        <textarea name="alamat" 
                  class="form-control mb-3 @error('alamat') is-invalid @enderror"
                  placeholder="Masukkan Alamat">{{ old('alamat', $edit->alamat) }}</textarea>
        @error('alamat')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- ROLE --}}
        <label>Role</label>
        <select name="role" class="form-control mb-3 @error('role') is-invalid @enderror">
            <option value="1" {{ $edit->role == 1 ? 'selected' : '' }}>1. SuperAdmin</option>
            <option value="0" {{ $edit->role == 0 ? 'selected' : '' }}>0. Admin</option>
            <option value="2" {{ $edit->role == 2 ? 'selected' : '' }}>2. Customer/User</option>
        </select>
        @error('role')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- PASSWORD --}}
        <label>Password (kosongkan jika tidak diubah)</label>
        <input type="password" name="password"
               class="form-control mb-3 @error('password') is-invalid @enderror"
               placeholder="Kosongkan jika tidak ingin mengganti password">
        @error('password')
            <small class="text-danger">{{ $message }}</small>
        @enderror

        {{-- BUTTON --}}
        <button type="submit" class="btn-primary-custom">Perbaharui</button>
        <a href="{{ route('backend.user.index') }}" class="btn-secondary-custom">Batal</a>

    </form>
</div>

@endsection
