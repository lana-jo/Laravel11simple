<?php

namespace App\Http\Controllers;

use App\Models\Returning_item;
use Illuminate\Http\Request;
use App\Models\BorrowingItem;


class ReturningItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function edit($id)
    {
        $returning = BorrowingItem::with(['rental', 'rental.item'])->findOrFail($id);
        return view('returnings.edit', compact('returning'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'return_date' => 'required|date',
            'condition' => 'required|string|max:255',
            'fine_amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000'
        ]);
    
        try {
            $returning = Returnings::findOrFail($id);
            
            \DB::transaction(function() use ($returning, $validated) {
                $returning->update($validated);
            });
    
            return redirect()
                ->route('returnings.index')
                ->with('success', 'Data pengembalian berhasil diperbarui!');
    
        } catch (\Exception $e) {
            \Log::error('Error updating returning: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }
    
    public function destroy($id)
    {
        try {
            $returning = BorrowingItem::findOrFail($id);
            
            \DB::transaction(function() use ($returning) {
                $returning->delete();
            });
    
            return redirect()
                ->route('returnings.index')
                ->with('success', 'Data pengembalian berhasil dihapus!');
    
        } catch (\Exception $e) {
            \Log::error('Error deleting returning: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
    
    public function index()
    {
        //
        $borrowings = BorrowingItem::where('status', 'borrowed')->get();

        return view('returnings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Returning_item $returning_item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Returning_item $returning_item)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Returning_item $returning_item)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Returning_item $returning_item)
    // {
    //     //
    // }

    public function returnItem($borrowing_id)
    {
        $borrowing = BorrowingItem::findOrFail($borrowing_id); // Menggunakan model BorrowingItem
        $borrowing->status = 'returned'; // Memperbarui status
        $borrowing->save();

        return redirect()->route('returnings.index')->with('success', 'Barang telah dikembalikan.');
    }


}
