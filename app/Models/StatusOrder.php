<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    use HasFactory;

    protected $table = 'status_order';

    protected $fillable = [
        'name', // Trường name có thể gán giá trị
    ];

    public function orders()
    {
        return $this->hasMany(OrderModel::class, 'status_id', 'id'); // status_id là khóa ngoại trong bảng orders
    }

}
