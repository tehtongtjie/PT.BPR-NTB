<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;

class PromoController extends Controller
{
    public function create()
    {
        // karena ada di admin/main/promo/create.blade.php
        return view('admin.main.promo.create');
    }

    public function edit(Promo $promo)
    {
        return view('admin.main.promo.edit', compact('promo'));
    }
}
