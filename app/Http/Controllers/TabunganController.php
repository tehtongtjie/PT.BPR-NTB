<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TabunganController extends Controller
{
    /**
     * Menampilkan detail produk tabungan berdasarkan slug
     */
    public function show(string $slug)
    {
        $tabungan = config("tabungan.$slug");

        // Jika slug tidak ditemukan di config
        if (!$tabungan) {
            abort(404);
        }

        return view('tabungan.show', compact('tabungan'));
    }
}
