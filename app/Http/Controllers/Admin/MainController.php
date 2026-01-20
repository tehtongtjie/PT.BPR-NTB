<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;

class MainController extends Controller
{
    public function index()
    {
        return view('admin.main.index', [
            'promos' => Promo::latest()->paginate(5), // maksimal 5
            'banners' => collect(),  // sementara
            'articles' => collect(), // sementara
        ]);
    }
}
