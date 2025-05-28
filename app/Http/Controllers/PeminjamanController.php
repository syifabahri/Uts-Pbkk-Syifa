<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = Peminjaman::with(['user', 'buku'])->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $peminjaman = Peminjaman::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dibuat.',
            'data' => $peminjaman
        ], 201);
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['user', 'buku'])->find($id);
        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Data peminjaman tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $peminjaman
        ]);
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Data peminjaman tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
        ]);

        $peminjaman->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diperbarui.',
            'data' => $peminjaman
        ]);
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::find($id);
        if (!$peminjaman) {
            return response()->json([
                'success' => false,
                'message' => 'Data peminjaman tidak ditemukan.'
            ], 404);
        }

        $peminjaman->delete();

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil dihapus.'
        ]);
    }
}
