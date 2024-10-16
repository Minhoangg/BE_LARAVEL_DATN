<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingAddressModel extends Model
{
    use HasFactory;

    protected $table = 'shipping_address';

    protected $fillable = [
        'city',
        'district',
        'ward',
        'city_code',
        'district_code',
        'ward_code',
        'street_address',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
