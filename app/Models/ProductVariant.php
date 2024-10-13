<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;


    protected $table = 'product_variants';

    // Các cột được phép mass assign
    protected $fillable= ['id_product', 'id_variant_attribute'];

    // Quan hệ với bảng product
    public function product()
    {
        return $this->belongsTo(Product::class,'id_product');    
    }

    public function variantAttribute()
{
    return $this->belongsTo(VariantAttribute::class,'id_variant_attribute');
}


}
