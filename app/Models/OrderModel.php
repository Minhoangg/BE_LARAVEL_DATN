<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total',
        'status_id',
        'sku_order',
        'province_code',
        'district_code',
        'ward_code',
        'street_address',
    ];

    public function status()
    {
        return $this->belongsTo(StatusOrder::class, 'status_id', 'id');
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'product_orders', 'order_id', 'product_id');
    }
}
