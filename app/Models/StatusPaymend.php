<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusPaymend extends Model
{
    use HasFactory;

    protected $table = 'paymend_status';

    protected $fillable = [
        'name', // Trường name có thể gán giá trị
    ];

    public function orders()
    {
        return $this->hasMany(OrderModel::class, 'paymend_status_id', 'id'); // status_id là khóa ngoại trong bảng orders
    }

}
