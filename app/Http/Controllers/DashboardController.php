<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBarang = Barang::count();
        $totalKategori = Kategori::count();
        $totalNilaiInventaris = (int) Barang::sum(DB::raw('harga * stok'));

        return view('dashboard', compact(
            'totalBarang',
            'totalKategori',
            'totalNilaiInventaris'
        ));
    }
}
