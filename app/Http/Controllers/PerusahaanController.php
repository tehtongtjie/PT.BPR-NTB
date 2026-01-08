<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function show($slug)
    {
        $data = config("perusahaan.$slug");

        if (!$data) {
            abort(404);
        }

        return view('perusahaan.show', compact('data', 'slug'));
    }
}
