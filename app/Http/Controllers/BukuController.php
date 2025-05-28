<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{

    public function index()
    {
        $bukus = Buku::all();
        return response()->json([
            'success' => true,
            'data' => $bukus
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'isbn' => 'required|string',
            'publisher' => 'required|string',
            'year_published' => 'required|string',
            'stock' => 'required|integer',
        ]);

        $buku = Buku::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil ditambahkan.',
            'data' => $buku
        ], 201);
    }

    public function show($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Data buku tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $buku
        ]);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Data buku tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string',
            'isbn' => 'required|string',
            'publisher' => 'required|string',
            'year_published' => 'required|string',
            'stock' => 'required|integer',
        ]);

        $buku->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil diperbarui.',
            'data' => $buku
        ]);
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'success' => false,
                'message' => 'Data buku tidak ditemukan.'
            ], 404);
        }

        $buku->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data buku berhasil dihapus.'
        ]);
    }
}