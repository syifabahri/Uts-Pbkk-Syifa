<?php

namespace App\Http\Controllers;

use App\Models\PengarangBuku;
use Illuminate\Http\Request;

class PengarangBukuController extends Controller
{
    public function index()
    {
        $relasi = PengarangBuku::with(['buku', 'pengarang'])->get();
        return response()->json([
            'success' => true,
            'data' => $relasi
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'pengarang_id' => 'required|exists:pengarangs,id',
        ]);

        $existing = PengarangBuku::where('buku_id', $validated['buku_id'])
                        ->where('pengarang_id', $validated['pengarang_id'])
                        ->first();
        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'Relasi buku-pengarang sudah ada.'
            ], 409);
        }

        $relasi = PengarangBuku::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Relasi berhasil ditambahkan.',
            'data' => $relasi
        ], 201);
    }

    public function show($id)
    {
        $relasi = PengarangBuku::with(['buku', 'pengarang'])->find($id);
        if (!$relasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data relasi tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $relasi
        ]);
    }

    public function update(Request $request, $id)
    {
        $relasi = PengarangBuku::find($id);
        if (!$relasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data relasi tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'pengarang_id' => 'required|exists:pengarangs,id',
        ]);

        $exists = PengarangBuku::where('buku_id', $validated['buku_id'])
            ->where('pengarang_id', $validated['pengarang_id'])
            ->where('id', '!=', $id)
            ->first();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Relasi baru sudah ada.'
            ], 409);
        }

        $relasi->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Relasi berhasil diperbarui.',
            'data' => $relasi
        ]);
    }


    public function destroy($id)
    {
        $relasi = PengarangBuku::find($id);
        if (!$relasi) {
            return response()->json([
                'success' => false,
                'message' => 'Data relasi tidak ditemukan.'
            ], 404);
        }

        $relasi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Relasi berhasil dihapus.'
        ]);
    }
}
