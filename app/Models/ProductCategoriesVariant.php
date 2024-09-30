<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategoriesVariant extends Model
{
    use HasFactory;

    protected $table = 'product_categories_variant';

    // Các cột được phép mass assign
    protected $fillable = ['id_product_categories', 'id_variant'];

    // Quan hệ với bảng product_categories
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'id_product_categories');
    }

    // Quan hệ với bảng variants
    public function variant()
    {
        return $this->belongsTo(Variant::class, 'id_variant');
    }
}
