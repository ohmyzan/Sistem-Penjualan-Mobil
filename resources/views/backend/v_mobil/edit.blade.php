@extends('backend.v_layouts.app')
@section('content')

<h3>{{ $judul }}</h3>

<form action="{{ route('backend.mobil.update', $edit->id) }}" method="POST">
    @method('PUT')
    @csrf

    {{-- NAMA MOBIL --}}
    <label>Nama Mobil</label><br>
    <input type="text"
        name="nama_mobil"
        value="{{ old('nama_mobil', $edit->nama_mobil) }}"
        placeholder="Masukkan Nama Mobil"
        class="form-control @error('nama_mobil') is-invalid @enderror">
    @error('nama_mobil')
        <span class="invalid-feedback alert-danger">{{ $message }}</span>
    @enderror
    <p></p>

    {{-- BRAND --}}
    <label>Brand</label><br>
    <input type="text"
        name="brand"
        value="{{ old('brand', $edit->brand) }}"
        placeholder="Masukkan Brand Mobil"
        class="form-control @error('brand') is-invalid @enderror">
    @error('brand')
        <span class="invalid-feedback alert-danger">{{ $message }}</span>
    @enderror
    <p></p>

    {{-- TAHUN --}}
    <label>Tahun</label><br>
    <input type="number"
        name="tahun"
        value="{{ old('tahun', $edit->tahun) }}"
        placeholder="Masukkan Tahun Mobil"
        class="form-control @error('tahun') is-invalid @enderror">
    @error('tahun')
        <span class="invalid-feedback alert-danger">{{ $message }}</span>
    @enderror
    <p></p>

    {{-- STOK --}}
    <label>Stok</label><br>
    <input type="number"
        name="stok"
        value="{{ old('stok', $edit->stok) }}"
        placeholder="Masukkan Jumlah Stok"
        class="form-control @error('stok') is-invalid @enderror">
    @error('stok')
        <span class="invalid-feedback alert-danger">{{ $message }}</span>
    @enderror
    <p></p>

    {{-- WARNA --}}
    <label>Warna</label><br>
    <input type="text"
        name="warna"
        value="{{ old('warna', $edit->warna) }}"
        placeholder="Masukkan Warna Mobil"
        class="form-control @error('warna') is-invalid @enderror">
    @error('warna')
        <span class="invalid-feedback alert-danger">{{ $message }}</span>
    @enderror
    <p></p>

    {{-- HARGA --}}
    <label>Harga</label><br>
    <input type="number"
        name="harga"
        value="{{ old('harga', $edit->harga) }}"
        placeholder="Masukkan Harga Beli"
        class="form-control @error('harga') is-invalid @enderror">
    @error('harga')
        <span class="invalid-feedback alert-danger">{{ $message }}</span>
    @enderror
    <p></p>

    {{-- KAPASITAS --}}
    <label>Kapasitas</label><br>
    <input type="number"
        name="kapasitas"
        value="{{ old('kapasitas', $edit->kapasitas) }}"
        placeholder="Masukkan Jumlah Penumpang"
        class="form-control @error('kapasitas') is-invalid @enderror">
    @error('kapasitas')
        <span class="invalid-feedback alert-danger">{{ $message }}</span>
    @enderror
    <p></p>

    {{-- BUTTON --}}
    <button type="submit">Perbaharui</button>

    <button type="button" onclick="window.location='{{ route('backend.mobil.index') }}'">
        Batal
    </button>

</form>

@endsection
