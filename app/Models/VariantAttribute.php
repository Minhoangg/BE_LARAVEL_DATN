<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    use HasFactory;
    protected $table = 'variant_attributes';
    protected $fields = [
        'name',
        'color_code',
        'id_variant',
    ];
    public function productVariants()
{
    return $this->hasMany(ProductVariant::class, 'id');
}
}
