<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $fillable = [
        'image',
        'title',
        'short_desc',
        'is_active',
    ];
}
