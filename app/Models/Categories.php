<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categories extends Model
{
    protected $fillable = [
        'category_name',
    ];

    /**
     * Get items associated with this category
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Items::class, 'category_id');
    }

    /**
     * Get category by ID
     * 
     * @param int $id
     * @return Categories|null
     */
    public function findCategory($id)
    {
        return $this->find($id);
    }

    /**
     * Get all categories ordered by name
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCategories()
    {
        return $this->orderBy('category_name', 'asc')->get();
    }
}
