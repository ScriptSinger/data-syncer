<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'category_id', 'description', 'price'];

    /**
     * Цена хранится в копейках, но представляется в рублях.
     */
    public function getPriceAttribute($value)
    {
        return $value / 100; // Перевод из копеек в рубли
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = round($value * 100); // Перевод в копейки
    }

    /**
     * Привязка к категории.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
