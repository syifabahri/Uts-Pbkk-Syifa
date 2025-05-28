<?php

namespace App\Http\Controllers;

use App\Models\Pengarang;
use Illuminate\Http\Request;

class PengarangController extends Controller
{
    public function index()
    {
        $pengarangs = Pengarang::all();
        return response()->json([
            'success' => true,
            'data' => $pengarangs
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'nationality' => 'required|string',
            'birthdate' => 'required|date',
        ]);

        $pengarang = Pengarang::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pengarang berhasil ditambahkan.',
            'data' => $pengarang
        ], 201);
    }

    public function show($id)
    {
        $pengarang = Pengarang::find($id);
        if (!$pengarang) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengarang tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pengarang
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengarang = Pengarang::find($id);
        if (!$pengarang) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengarang tidak ditemukan.'
            ], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string',
            'nationality' => 'required|string',
            'birthdate' => 'required|date',
        ]);

        $pengarang->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pengarang berhasil diperbarui.',
            'data' => $pengarang
        ]);
    }

    public function destroy($id)
    {
        $pengarang = Pengarang::find($id);
        if (!$pengarang) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengarang tidak ditemukan.'
            ], 404);
        }

        $pengarang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pengarang berhasil dihapus.'
        ]);
    }
}
