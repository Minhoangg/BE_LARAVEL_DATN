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
}
