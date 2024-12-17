<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Categories;
use Illuminate\Http\Request;

class ItemsController extends Controller
{

    

    public function index()
    {
        // $items = Items::join('categories', 'items.category_id', '=', 'categories.id')
        //     ->select('items.*', 'categories.category_name')
        //     ->get();
        $items = Items::with('category')->get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('items.create', compact('categories'));
    }

    
    

    public function show(Items $items)
    {
        // Implementation for showing single item
    }

    public function destroy($id)
    {
        try {
            $item = Items::findOrFail($id);
            
            // Delete associated image if exists
            if ($item->image) {
                \Storage::disk('public')->delete($item->image);
            }
            
            \DB::transaction(function() use ($item) {
                $item->delete();
            });

            return redirect()
                ->route('items.index')
                ->with('success', 'Data berhasil dihapus!');
                
        } catch (\Exception $e) {
            \Log::error('Error deleting item: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    public function edit($id)
    {
        $item = Items::findOrFail($id);
        $categories = Categories::all();
        
        return view('items.edit', compact('item', 'categories'));
    }

public function store(Request $request)
{
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
            // 'dimensions:max_width=48,max_height=48'
            'dimensions:min_width=100,min_height=100,max_width=4000,max_height=4000'
        ]
    ]);

    try {
        $item = new Items($validated);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $extension = $request->image->extension();
            $fileName = time() . '_' . hash('sha256', $request->image->getClientOriginalName()) . '.' . $extension;
            $imagePath = $request->file('image')->storeAs('images', $fileName, 'public');
            $item->image = $imagePath;
        }

        \DB::transaction(function() use ($item) {
            $item->save();
        });

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


    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|regex:/^[\w\s-]*$/|unique:items,name,' . $id,
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
            $item = Items::findOrFail($id);

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                if ($item->image) {
                    \Storage::disk('public')->delete($item->image);
                }
                
                $extension = $request->image->extension();
                $fileName = time() . '_' . hash('sha256', $request->image->getClientOriginalName()) . '.' . $extension;
                $imagePath = $request->file('image')->storeAs('images', $fileName, 'public');
                $validated['image'] = $imagePath;
            }

            \DB::transaction(function() use ($item, $validated) {
                $item->update($validated);
            });

            return redirect()
                ->route('items.index')
                ->with('success', 'Data berhasil diperbarui!');

        } catch (\Exception $e) {
            \Log::error('Error updating item: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }
}