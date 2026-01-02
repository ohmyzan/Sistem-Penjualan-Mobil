@extends('backend.v_layouts.app')

@section('content')

<style>
    .page-title {
        font-weight: 700;
        color: #001437;
        font-size: 28px;
        margin-bottom: 18px;
    }

    .form-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 25px;
        border-left: 6px solid #7898FB;
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    }

    .btn-simpan {
        background: linear-gradient(135deg, #001437, #7898FB);
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        color: white;
        transition: .25s;
        margin-top: 10px;
    }

    .btn-simpan:hover {
        opacity: .85;
    }

    .btn-batal {
        background: #EA5555;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        color: white;
        margin-right: 10px;
        transition: .25s;
        margin-top: 10px;
    }

    .btn-batal:hover {
        opacity: .85;
    }
</style>

<h3 class="page-title">{{ $judul }}</h3>

<div class="form-card">

    <form action="{{ route('backend.merk.store') }}" method="POST">
        @csrf

        {{-- INPUT MERK --}}
        <label>Nama Merk</label><br>
        <input type="text"
               name="nama_merk"
               value="{{ old('nama_merk') }}"
               placeholder="Masukkan Nama Merk"
               class="form-control @error('nama_merk') is-invalid @enderror">

        @error('nama_merk')
            <span class="invalid-feedback alert-danger mt-1">{{ $message }}</span>
        @enderror

        <label>Negara asal</label><br>
        <input type="text"
               name="negara_asal"
               value="{{ old('negara_asal') }}"
               placeholder="Masukkan Negara Asal"
               class="form-control @error('negara_asal') is-invalid @enderror">

        @error('negara_asal')
            <span class="invalid-feedback alert-danger mt-1">{{ $message }}</span>
        @enderror

        <br>

        {{-- BUTTON --}}
        <button type="button"
                onclick="window.location='{{ route('backend.merk.index') }}'"
                class="btn-batal">
            Batal
        </button>

        <button type="submit" class="btn-simpan">
            Simpan
        </button>

    </form>

</div>

@endsection
