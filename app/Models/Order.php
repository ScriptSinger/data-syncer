<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'created_at', 'status', 'comment', 'product_id', 'quantity', 'total_price'];

    protected $casts = [
        'created_at' => 'datetime',
        'status' => 'boolean',
    ];

    /**
     * Цена хранится в копейках, но представляется в рублях.
     */
    public function getTotalPriceAttribute($value)
    {
        return $value / 100; // Перевод из копеек в рубли
    }

    public function setTotalPriceAttribute($value)
    {
        $this->attributes['total_price'] = round($value * 100); // Перевод в копейки
    }

    /**
     * Заказ содержит один товар.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Получение текстового статуса заказа.
     */
    public function getStatusTextAttribute()
    {
        return $this->status ? 'Выполнен' : 'Новый';
    }
}
