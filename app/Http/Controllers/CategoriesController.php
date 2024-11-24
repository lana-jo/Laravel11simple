<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    // Method untuk menampilkan form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    public function edit($id)
    {
        // Mencari kategori berdasarkan ID
        $category = Categories::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    // Method untuk menyimpan kategori baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        // Membuat kategori baru dan menyimpannya
        Categories::create([
            'category_name' => $request->category_name,
        ]);

        // Mengalihkan ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Method untuk menampilkan daftar kategori
    public function index()
    {
        // Mengambil semua kategori
        $categories = Categories::all();

        // Mengirimkan data kategori ke view
        return view('categories.index', compact('categories'));
    }

    // Method untuk mengupdate kategori
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'category_name' => 'required',
        ]);

        // Mencari kategori berdasarkan ID
        $categories = Categories::findOrFail($id);

        // Memperbarui data kategori
        $categories->category_name = $request->category_name;
        $categories->save();

        // Mengalihkan kembali ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    // Method untuk menghapus kategori
    public function delete($id)
    {
        // Mencari kategori berdasarkan ID
        $categories = Categories::findOrFail($id);

        // Menghapus kategori
        $categories->delete();

        // Mengalihkan kembali ke halaman kategori dengan pesan sukses
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
