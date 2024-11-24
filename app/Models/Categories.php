<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    protected $fillable = [
        'category_name',
    ];
    /**
     * Mendapatkan kategori berdasarkan ID.
     * 
     * Fungsi ini mengembalikan query SQL untuk mendapatkan kategori dengan ID tertentu.
     *
     * @param int $id ID dari kategori yang ingin didapatkan.
     * 
     * @return string Query SQL untuk mengambil kategori.
     */
    public function get_categories_by_id($id)
    {
        $query = "SELECT * FROM categories WHERE id = $id order by category_name ASC";
        $result = \DB::select($query);
        if(count($result) > 0){
            return $result;
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil kategori',
            ], 400);
        }
    }

    /**
     * Mendapatkan kategori berdasarkan ID menggunakan eloquent.
     * 
     * Fungsi ini mencari kategori dalam database berdasarkan ID dan mengembalikan objek pertama yang ditemukan.
     *
     * @param int $id ID dari kategori yang ingin didapatkan.
     * 
     * @return \Illuminate\Database\Eloquent\Model|null Kategori yang ditemukan atau null jika tidak ada.
     * 
     */
    public function getById($id)
    {
        $category = $this->where('id', $id)->first();
        if(!$category){
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil kategori',
            ], 400);
        }
        return $category;
    }

}
