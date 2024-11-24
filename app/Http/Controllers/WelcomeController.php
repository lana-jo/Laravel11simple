<?php

namespace App\Http\Controllers;

use App\Models\Items;

class WelcomeController extends Controller
{
    public function index()
    {
        $items = Items::all();
        return view('welcome', compact('items'));
    }
}
