<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $table = 'variants';
    protected $fields = [
        'name',
    ];
    public function variantAttributes()
    {
        return $this->hasMany(VariantAttribute::class, 'id_variant', 'id');
    }
}
