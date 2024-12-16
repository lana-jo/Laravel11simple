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
    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
 
}
