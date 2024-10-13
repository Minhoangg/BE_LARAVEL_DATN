<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [ 'product_id', 'user_id', 'quantity','id_variant'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'id_variant', ); 
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
