<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Produk Routes
    Route::post('/produk/create', [ProdukController::class, 'create']);
    Route::get('/produk/read', [ProdukController::class, 'read']);
    Route::post('/produk/update', [ProdukController::class, 'update']); // Using POST for update to handle body data easily
    Route::post('/produk/delete', [ProdukController::class, 'delete']); // Using POST for delete as per common RPC style if not DELETE method

    // Kategori Routes
    Route::post('/kategori/create', [KategoriController::class, 'create']);
    Route::get('/kategori/read', [KategoriController::class, 'read']);
    Route::post('/kategori/update', [KategoriController::class, 'update']);
    Route::post('/kategori/delete', [KategoriController::class, 'delete']);

    // Pelanggan Routes
    Route::post('/pelanggan/create', [PelangganController::class, 'create']);
    Route::get('/pelanggan/read', [PelangganController::class, 'read']);
    Route::post('/pelanggan/update', [PelangganController::class, 'update']);
    Route::post('/pelanggan/delete', [PelangganController::class, 'delete']);
});
