@extends('backend.v_layouts.app')

@section('content')
<style>
    .page-title {
        font-weight: 700;
        color: #001437;
        font-size: 28px;
        margin-bottom: 12px;
    }

    /* Kartu container (mirip info-box/dashboard) */
    .custom-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 25px;
        border-left: 6px solid #7898FB;
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        color: #001437;
    }

    /* Tombol Tambah */
    .btn-tambah {
        background: linear-gradient(135deg, #001437, #7898FB);
        border: none;
        padding: 9px 18px;
        border-radius: 8px;
        font-weight: 600;
        color: white;
        transition: 0.25s;
    }

    .btn-tambah:hover {
        opacity: 0.85;
    }

    /* TABEL */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 18px;
    }

    /* Header tabel = gradient dashboard */
    table thead {
        background: linear-gradient(120deg, #001437, #0a2b6d, #7898FB);
        color: white;
    }

    table th {
        padding: 12px 14px;
        text-align: left;
        font-size: 14px;
        letter-spacing: 0.5px;
    }

    table td {
        padding: 12px 14px;
        font-size: 14.5px;
        color: #001437;
        border-bottom: 1px solid #e3e6f5;
    }

    /* Warna baris lembut */
    table tbody tr:nth-child(odd) {
        background: #f7f9ff;
    }

    table tbody tr:nth-child(even) {
        background: #eef2ff;
    }

    table tbody tr:hover {
        background: #d9e2ff;
        transition: 0.2s;
    }

    /* Tombol Aksi */
    .btn-ubah {
        background: #7898FB;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        color: white;
        font-weight: 600;
        transition: 0.2s;
    }
    .btn-ubah:hover {
        background: #145a8fff;
        color: #001437;
    }

    .btn-hapus {
        background: #EA5555;
        border: none;
        padding: 6px 12px;
        border-radius: 6px;
        color: white;
        font-weight: 600;
    }
    .btn-hapus:hover {
        opacity: .85;
    }

    /* Alert Sukses */
    .alert-success {
        background: linear-gradient(135deg, #001437, #7898FB);
        color: white;
        border: none;
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 18px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.18);
        letter-spacing: .3px;
    }
</style>


<h3 class="page-title">{{ $judul }}</h3>

<div class="custom-card mt-3">

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

    <a href="{{ route('backend.user.create') }}">
        <button type="button" class="btn-tambah">+ Tambah User</button>
        </a>

   <form action="{{ route('backend.user.index') }}" method="GET">
     <input type="text" name="search" value="{{ request('search') }}">
     <button type="submit" hidden></button>
    </form>

    </div>
    <table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>No HP</th>
            <th>Role</th> <!-- Tambahin ini -->
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($index as $row)
        <tr>
            <td>{{ $index->firstItem() + $loop->index }}</td>
            <td>{{ $row->nama }}</td>
            <td>{{ $row->no_hp }}</td>
            <td>
                @if($row->role == 2)
                    User
                @elseif($row->role == 0)
                    Admin
                @elseif($row->role == 1)
                    Super Admin
                @else
                    Tidak Diketahui
                @endif
            </td>
            <td style="display:flex; gap:6px;">

                <a href="{{ route('backend.user.edit', $row->id) }}">
                    <button type="button" class="btn-ubah">Ubah</button>
                </a>

                <form action="{{ route('backend.user.destroy', $row->id) }}" 
                      method="POST"
                      onsubmit="return confirm('Yakin mau hapus user ini?')">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn-hapus">Hapus</button>
                </form>
                

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="mt-3 d-flex justify-content-center">
    {{ $index->links('pagination::bootstrap-5') }}
</div>

</div>

@endsection
