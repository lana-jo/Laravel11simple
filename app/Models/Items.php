<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'stock',
    ];

    // Relasi dengan Category
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
