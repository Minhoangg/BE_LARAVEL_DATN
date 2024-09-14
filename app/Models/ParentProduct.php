<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentProduct extends Model
{
    use HasFactory;
    protected $table = 'parent_products';
    protected $fields = [
        'categories_id',
        'name',
        'desc',
        'short_desc',
        'avatar',
    ];
}
