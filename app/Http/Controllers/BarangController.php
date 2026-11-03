<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BarangController extends Controller
{
    public function index(): View
    {
        $barangs = Barang::with('kategori')->orderBy('nama')->get();
        $kategoris = Kategori::orderBy('nama')->get();

        return view('barang.index', compact('barangs', 'kategoris'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'nama' => ['required', 'string', 'max:150'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'nama.required' => 'Nama barang wajib diisi.',
            'harga.required' => 'Harga barang wajib diisi.',
            'stok.required' => 'Stok barang wajib diisi.',
        ]);

        Barang::create($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, Barang $barang): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'exists:kategoris,id'],
            'nama' => ['required', 'string', 'max:150'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ], [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori tidak valid.',
            'nama.required' => 'Nama barang wajib diisi.',
            'harga.required' => 'Harga barang wajib diisi.',
            'stok.required' => 'Stok barang wajib diisi.',
        ]);

        $barang->update($validated);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Barang $barang): RedirectResponse
    {
        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
