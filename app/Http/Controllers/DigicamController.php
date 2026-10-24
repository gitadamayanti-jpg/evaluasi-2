<?php

namespace App\Http\Controllers;

use App\Models\Digicam;
use App\Models\KategoriDigicam;
use Illuminate\Http\Request;

class DigicamController extends Controller
{
    public function index(Request $request)
    {
        $title = "Daftar Digicam";
        $query = Digicam::query();

        // Pencarian berdasarkan nama atau merek
        if ($request->filled('cari')) {
            $cari = $request->cari;

            $query->where(function ($q) use ($cari) {
                $q->where('nama', 'like', "%{$cari}%")
                  ->orWhere('merek', 'like', "%{$cari}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        $digicam = $query->paginate(5);
        $kategoris = KategoriDigicam::all();

        return view('admin.daftardigicam', compact(
            'title',
            'digicam',
            'kategoris'
        ));
    }

    public function create()
    {
        $title = "Tambah Digicam";
        $kategoris = KategoriDigicam::all();

        return view('admin.inputdigicam', compact('title', 'kategoris'));
    }

    public function store(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'merek' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable',
            'id_kategori' => 'nullable|exists:kategori_digicams,id_kategori',
        ]);

        Digicam::create($validasi);

        return redirect()->route('digicam.index')
            ->with('success', 'Digicam berhasil ditambahkan.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $title = "Edit Digicam";
        $kategoris = KategoriDigicam::all();
        $digicam = Digicam::findOrFail($id);

        return view(
            'admin.inputdigicam',
            compact('title', 'kategoris', 'digicam')
        );
    }

    public function update(Request $request, $id)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'merek' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'deskripsi' => 'nullable',
            'id_kategori' => 'nullable|exists:kategori_digicams,id_kategori',
        ]);

        $digicam = Digicam::findOrFail($id);
        $digicam->update($validasi);

        return redirect()->route('digicam.index')
            ->with('success', 'Data digicam berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $digicam = Digicam::findOrFail($id);
        $digicam->delete();

        return redirect()->route('digicam.index')
            ->with('success', 'Digicam berhasil dihapus.');
    }
}
