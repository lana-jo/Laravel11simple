<?php

namespace App\Http\Controllers;

use App\Models\Borrowing_item;
use App\Models\Items;
use Illuminate\Http\Request;

class BorrowingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $borrowings = Borrowing_item::all(); // Mengambil semua data peminjaman
        return view('borrowings.index', compact('borrowings')); // Menampilkan daftar peminjaman ke view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Items::all(); // Mengambil data barang untuk ditampilkan di form
        return view('borrowings.create', compact('items'));
    }

    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'item_id' => 'required|exists:items,id',  // Validasi item yang dipilih ada di database
            'borrowing_date' => 'required|date',
        ]);

        // Menyimpan data peminjaman dan menyertakan ID pengguna yang sedang login
        Borrowing_Item::create([
            'customer_name' => $request->customer_name,
            'item_id' => $request->item_id,
            'borrowing_date' => $request->borrowing_date,
            'status' => 'borrowed',
            'user_id' => auth()->id(),  // Menambahkan user_id yang berhubungan dengan pengguna yang sedang login
        ]);

        // Redirect ke halaman peminjaman dengan pesan sukses
        return redirect()->route('borrowings.index')->with('success', 'Peminjaman barang berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Borrowing_item $borrowing_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Borrowing_item $borrowing_item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Borrowing_item $borrowing_item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Borrowing_item $borrowing_item)
    {
        //
    }

    public function return(BorrowingItem $borrowing)
{
    // Memperbarui status peminjaman menjadi "returned"
    $borrowing->status = 'returned';
    $borrowing->save();

    // Kembali ke halaman daftar peminjaman dengan pesan sukses
    return redirect()->route('borrowings.index')->with('success', 'Barang telah dikembalikan.');
}
}
