<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $table = 'wishlists';
    protected $fillable = [
        'name',
        'product_id',
        'user_id',
    ];

    public function productWishlist()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function userWishlist()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}