<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Returning_item extends Model
{
    //
    protected $fillable = [
        'borrowing_item_id',
        'returning_date',
    ];
}
