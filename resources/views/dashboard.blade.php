@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
<div class="stats">
    <div class="stat glass">
        <div class="stat-body">
            <strong>{{ $totalBarang }}</strong>
            <span>Total Barang</span>
            <i class="bi bi-boxes stat-icon"></i>
        </div>
        <a href="{{ route('barang.index') }}" class="stat-more">More info <i class="bi bi-arrow-right-circle"></i></a>
    </div>

    <div class="stat glass">
        <div class="stat-body">
            <strong>{{ $totalKategori }}</strong>
            <span>Total Kategori</span>
            <i class="bi bi-tags stat-icon"></i>
        </div>
        <a href="{{ route('kategori.index') }}" class="stat-more">More info <i class="bi bi-arrow-right-circle"></i></a>
    </div>

    <div class="stat glass">
        <div class="stat-body">
            <strong>Rp {{ number_format($totalNilaiInventaris, 0, ',', '.') }}</strong>
            <span>Total Nilai Inventaris</span>
            <i class="bi bi-cash-stack stat-icon"></i>
        </div>
        <div class="stat-more stat-more--empty"></div>
    </div>
</div>
@endsection
