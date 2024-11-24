<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing_item extends Model
{
    //
    protected $fillable = [
        'user_id',
        'item_id',
        'customer_name',
        'borrowing_date',
    ];

    // Relasi dengan Item
    public function item()
    {
        return $this->belongsTo(Items::class);
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function returnItem($id)
    {
    $borrowingItem = Borrowing_item::findOrFail($id);

    // Mengubah status penyewaan menjadi 'returned'
    $borrowingItem->status = 'returned';
    $borrowingItem->save();

    // Mengupdate stok barang yang dikembalikan
    $item = $borrowingItem->item;
    $item->stock += 1;  // Menambah stok barang yang dikembalikan
    $item->save();

    return redirect()->route('borrowings.index')->with('success', 'Barang telah dikembalikan');
    }

}
