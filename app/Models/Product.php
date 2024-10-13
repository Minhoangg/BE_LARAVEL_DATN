<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fields = [
        'parent_id',
        'name',
        'price',
        'price_sale',
        'quantity',
        'avatar',
        'private_desc',
        'tag_sale',
    ];


    public function products(){
        return $this->belongsToMany(OrderModel::class, 'order_details', 'product_id', 'order_id');
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'id_product');

    }
}
