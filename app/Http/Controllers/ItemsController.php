<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Categories; // Menambahkan import model Category

use Illuminate\Http\Request;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//     public function index()
// {
//     $items = Item::with('category')->get();
//     return view('items.index', compact('items'));
// }

    // public function index()
    // {
    //     $items = Items::with('categories')->get();
    //     // $items = Items::all();  // Mendapatkan semua data items
    //     $categories = Categories::all(); // Mendapatkan semua data kategori
    //     return view('items.index', compact('items', 'categories')); // Mengirimkan data kategori ke tampilan;
    // }
    public function index()
{
    $items = Items::join('categories', 'items.category_id', '=', 'categories.id')
        ->select('items.*', 'categories.category_name')
        ->get();
    
    return view('items.index', compact('items'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Categories::all(); // Jika Anda memiliki kategori barang
        return view('items.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Strong input validation with specific rules
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|regex:/^[\w\s-]*$/|unique:items,name',
            'description' => 'required|string|max:1000|not_regex:/<script.*?>.*?<\/script>/is',
            'stock' => 'required|integer|min:0|max:999999',
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg',
                'max:2048',
                'dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000'
            ]
        ]);

        try {
            // Create new item with only validated data
            $item = new Items($validated);

            // Secure image handling with sanitized filename
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $fileName = time() . '_' . hash('sha256', $request->image->getClientOriginalName()) . '.' . $extension;
                $imagePath = $request->file('image')->storeAs('images', $fileName, 'public');
                $item->image = $imagePath;
            }

            // Save with database transaction
            \DB::transaction(function() use ($item) {
                $item->save();
            });

            // Clear any sensitive data from memory
            unset($validated);

            return redirect()
                ->route('items.index')
                ->with('success', 'Data berhasil ditambahkan!')
                ->withHeaders([
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                    'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT'
                ]);

        } catch (\Exception $e) {
            \Log::error('Error saving item: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Items $items)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Items $items)
    // {
    //     //
    //     $item = Items::findOrFail($items->id);
    //     $categories = Categories::all();
    //     return view('items.edit', compact('items', 'categories'));
    // }
    // public function edit($id)
    // {
    //     $item = Items::findOrFail($id);
    //     $categories = Categories::all();
    //     return view('items.edit', compact('item', 'categories'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, $id)
    // {
    //     $validated = $request->validate([
    //         'category_id' => 'required|exists:categories,id',
    //         'name' => 'required|string|max:255|regex:/^[\w\s-]*$/|unique:items,name,' . $id,
    //         'description' => 'required|string|max:1000|not_regex:/<script.*?>.*?<\/script>/is',
    //         'stock' => 'required|integer|min:0|max:999999',
    //         'image' => [
    //             'nullable',
    //             'image',
    //             'mimes:jpeg,png,jpg',
    //             'max:2048',
    //             'dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000'
    //         ]
    //     ]);

    //     try {
    //         $item = Items::findOrFail($id);
            
    //         // Handle image upload
    //         if ($request->hasFile('image') && $request->file('image')->isValid()) {
    //             // Delete old image
    //             if ($item->image) {
    //                 Storage::disk('public')->delete($item->image);
    //             }
                
    //             $extension = $request->image->extension();
    //             $fileName = time() . '_' . hash('sha256', $request->image->getClientOriginalName()) . '.' . $extension;
    //             $imagePath = $request->file('image')->storeAs('images', $fileName, 'public');
    //             $validated['image'] = $imagePath;
    //         }

    //         // Update using transaction
    //         \DB::transaction(function() use ($item, $validated) {
    //             $item->update($validated);
    //         });

    //         return redirect()
    //             ->route('items.index')
    //             ->with('success', 'Data barang berhasil diperbarui!')
    //             ->withHeaders([
    //                 'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
    //                 'Pragma' => 'no-cache',
    //                 'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT'
    //             ]);

    //     } catch (\Exception $e) {
    //         \Log::error('Error updating item: ' . $e->getMessage());
    //         return redirect()
    //             ->back()
    //             ->withInput()
    //             ->with('error', 'Terjadi kesalahan saat memperbarui data barang.');
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Items $items)
    {
        //
    }
}

