<?php

namespace App\Http\Controllers;

use App\Models\Items;

class WelcomeController extends Controller
{
    public function index()
    {
        // $items = Items::all();
        // return view('welcome', compact('items'));
        $items = Items::join('categories', 'items.category_id', '=', 'categories.id')
        ->select('items.*', 'categories.category_name')
        ->get();
        
        return view('welcome', compact('items'));
    }
}
