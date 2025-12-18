<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'kategori_id' => 'required|exists:kategori,id',
        ]);
        $produk = Produk::create($validated);
        return response()->json(['message' => 'Produk created', 'data' => $produk], 201);
    }

    public function read()
    {
        return response()->json(Produk::with('kategori')->get());
    }

    public function update(Request $request, $id = null)
    {
        $id = $id ?? $request->input('id');
        if (!$id) {
            return response()->json(['message' => 'ID is required'], 400);
        }
        $produk = Produk::findOrFail($id);
        
        $validated = $request->validate([
            'nama_produk' => 'sometimes|string|max:255',
            'harga' => 'sometimes|numeric',
            'stok' => 'sometimes|integer',
            'kategori_id' => 'sometimes|exists:kategori,id',
        ]);
        
        $produk->update($validated);
        return response()->json(['message' => 'Produk updated', 'data' => $produk]);
    }

    public function delete(Request $request, $id = null)
    {
        $id = $id ?? $request->input('id');
        if (!$id) {
            return response()->json(['message' => 'ID is required'], 400);
        }
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return response()->json(['message' => 'Produk deleted']);
    }
}
