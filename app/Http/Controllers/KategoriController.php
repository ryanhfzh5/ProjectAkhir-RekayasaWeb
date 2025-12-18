<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
        $kategori = Kategori::create($validated);
        return response()->json(['message' => 'Kategori created', 'data' => $kategori], 201);
    }

    public function read()
    {
        return response()->json(Kategori::all());
    }

    public function update(Request $request, $id = null)
    {
        $id = $id ?? $request->input('id');
        if (!$id) {
            return response()->json(['message' => 'ID is required'], 400);
        }
        $kategori = Kategori::findOrFail($id);
        
        $validated = $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);
        
        $kategori->update($validated);
        return response()->json(['message' => 'Kategori updated', 'data' => $kategori]);
    }

    public function delete(Request $request, $id = null)
    {
        $id = $id ?? $request->input('id');
        if (!$id) {
            return response()->json(['message' => 'ID is required'], 400);
        }
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return response()->json(['message' => 'Kategori deleted']);
    }
}
