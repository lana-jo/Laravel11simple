<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Borrowing_item;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Items::count();
        $totalBorrowings = Borrowing_item::count();
        return view('dashboard', compact('totalItems', 'totalBorrowings'));
        
    }
}
