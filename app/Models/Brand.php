<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';

    // Các cột được phép mass assign
    protected $fillable = ['name', 'desc', 'img', 'id_product_categories'];

    // Quan hệ với bảng product_categories
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'id_product_categories');
    }
}
