<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function create(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'nomor_telepon' => 'required|string',
            'alamat' => 'required|string',
        ]);
        $pelanggan = Pelanggan::create($validated);
        return response()->json(['message' => 'Pelanggan created', 'data' => $pelanggan], 201);
    }

    public function read()
    {
        return response()->json(Pelanggan::all());
    }

    public function update(Request $request, $id = null)
    {
        $id = $id ?? $request->input('id');
        if (!$id) {
            return response()->json(['message' => 'ID is required'], 400);
        }
        $pelanggan = Pelanggan::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:pelanggan,email,'.$id,
            'nomor_telepon' => 'sometimes|string',
            'alamat' => 'sometimes|string',
        ]);
        
        $pelanggan->update($validated);
        return response()->json(['message' => 'Pelanggan updated', 'data' => $pelanggan]);
    }

    public function delete(Request $request, $id = null)
    {
        $id = $id ?? $request->input('id');
        if (!$id) {
            return response()->json(['message' => 'ID is required'], 400);
        }
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return response()->json(['message' => 'Pelanggan deleted']);
    }
}
