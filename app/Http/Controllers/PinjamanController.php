<?php

namespace App\Http\Controllers;

class PinjamanController extends Controller
{
    /**
     * /pinjaman
     * Langsung arahkan ke pinjaman default
     */
    public function index()
    {
        return redirect()->route(
            'pinjaman.show',
            'kredit-modal-kerja'
        );
    }

    /**
     * /pinjaman/{slug}
     * Detail pinjaman
     */
    public function show($slug)
    {
        $pinjaman = config("pinjaman.$slug");

        if (!$pinjaman) {
            abort(404);
        }

        return view('pinjaman.show', compact('pinjaman'));
    }
}
