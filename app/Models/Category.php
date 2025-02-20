<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * Категория может иметь много товаров.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
