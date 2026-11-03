@extends('layouts.app')
@section('title', 'Data Barang')

@section('content')
<div class="page-head">
    <h2>DATA BARANG</h2>
    <div class="crumb">
        <a href="{{ route('dashboard') }}"><i class="bi bi-house-door"></i> Dashbord</a>
        <span>/</span>
        <i class="bi bi-box-seam"></i> Data Barang
    </div>
</div>

@if(session('success'))
    <div class="alert-success" style="margin-bottom: 1rem; background: rgba(40,167,69,.18); color: #dfffe9; padding: .8rem 1rem; border-radius: 10px;">
        {{ session('success') }}
    </div>
@endif

<section class="panel glass">
    <div class="panel-top">
        <button class="btn-soft" data-open="modalBarang"><i class="bi bi-plus-lg"></i> Tambah Data</button>
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
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th class="col-aksi"><i class="bi bi-gear"></i></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangs as $barang)
            <tr>
                <td>{{ $barang->id }}</td>
                <td>{{ $barang->nama }}</td>
                <td>Rp {{ number_format($barang->harga, 0, ',', '.') }}</td>
                <td>{{ $barang->stok }}</td>
                <td>{{ $barang->kategori?->nama ?? 'Tidak ada kategori' }}</td>
                <td class="col-aksi">
                    <button class="act act-edit" data-open="modalBarang-{{ $barang->id }}" aria-label="Edit"><i class="bi bi-pencil-square"></i></button>
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="act act-del" aria-label="Hapus" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash3-fill"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data barang.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection

@push('modals')
<div class="modal" id="modalBarang" aria-hidden="true">
    <div class="modal-box glass">
        <h3>Form Barang</h3>
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            <label>Nama Barang</label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Monitor" required>
            <label>Harga</label>
            <input type="number" name="harga" value="{{ old('harga') }}" min="0" placeholder="2000000" required>
            <label>Stok</label>
            <input type="number" name="stok" value="{{ old('stok') }}" min="0" placeholder="0" required>
            <label>Kategori</label>
            <select name="kategori_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                @endforeach
            </select>
            <div class="modal-actions">
                <button type="button" class="btn-soft" data-close>Batal</button>
                <button type="submit" class="btn-solid">Simpan</button>
            </div>
        </form>
    </div>
</div>

@foreach ($barangs as $barang)
<div class="modal" id="modalBarang-{{ $barang->id }}" aria-hidden="true">
    <div class="modal-box glass">
        <h3>Edit Barang</h3>
        <form action="{{ route('barang.update', $barang->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label>Nama Barang</label>
            <input type="text" name="nama" value="{{ old('nama', $barang->nama) }}" required>
            <label>Harga</label>
            <input type="number" name="harga" value="{{ old('harga', $barang->harga) }}" min="0" required>
            <label>Stok</label>
            <input type="number" name="stok" value="{{ old('stok', $barang->stok) }}" min="0" required>
            <label>Kategori</label>
            <select name="kategori_id" required>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $barang->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                @endforeach
            </select>
            <div class="modal-actions">
                <button type="button" class="btn-soft" data-close>Batal</button>
                <button type="submit" class="btn-solid">Update</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endpush
