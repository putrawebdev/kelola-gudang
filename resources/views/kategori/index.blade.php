@extends('layouts.app')
@section('title', 'Data Kategori')

@section('content')
<div class="page-head">
    <h2>DATA KATEGORI</h2>
    <div class="crumb">
        <a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i> Dashbord</a>
        <span>/</span>
        <i class="bi bi-tag"></i> Data Kategori
    </div>
</div>

@if(session('success'))
    <div class="alert-success" style="margin-bottom: 1rem; background: rgba(40,167,69,.18); color: #dfffe9; padding: .8rem 1rem; border-radius: 10px;">
        {{ session('success') }}
    </div>
@endif

<section class="panel glass">
    <div class="panel-top">
        <button class="btn-soft" data-open="modalKategori"><i class="bi bi-plus-lg"></i> Tambah Data</button>
        <button class="btn-soft" onclick="window.print()"><i class="bi bi-printer"></i> Cetak</button>
    </div>

    <div class="panel-tools">
        <select class="entries" aria-label="Jumlah data per halaman">
            <option>10</option><option>25</option><option>50</option>
        </select>
        <input type="text" class="table-search" placeholder="Search">
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama Kategori</th>
                <th class="col-aksi"><i class="bi bi-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategoris as $kategori)
            <tr>
                <td>{{ $kategori->id }}</td>
                <td>{{ $kategori->nama }}</td>
                <td class="col-aksi">
                    <button class="act act-edit" data-open="modalKategori-{{ $kategori->id }}" aria-label="Edit"><i class="bi bi-pencil-square"></i></button>
                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="act act-del" aria-label="Hapus" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash3-fill"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center">Belum ada data kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection

@push('modals')
<div class="modal" id="modalKategori" aria-hidden="true">
    <div class="modal-box glass">
        <h3>Form Kategori</h3>
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf
            <label>Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Elektronik" required>
            <div class="modal-actions">
                <button type="button" class="btn-soft" data-close>Batal</button>
                <button type="submit" class="btn-solid">Simpan</button>
            </div>
        </form>
    </div>
</div>

@foreach ($kategoris as $kategori)
<div class="modal" id="modalKategori-{{ $kategori->id }}" aria-hidden="true">
    <div class="modal-box glass">
        <h3>Edit Kategori</h3>
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>Nama Kategori</label>
            <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" required>
            <div class="modal-actions">
                <button type="button" class="btn-soft" data-close>Batal</button>
                <button type="submit" class="btn-solid">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endpush
