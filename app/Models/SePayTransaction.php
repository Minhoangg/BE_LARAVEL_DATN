<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SePayTransaction extends Model
{
    use HasFactory;

    protected $table = 'sepay_transactions';

    // Xác định các cột có thể mass-assign
    protected $fillable = [
        'gateway',
        'transactionDate',
        'accountNumber',
        'subAccount',
        'code',
        'content',
        'transferType',
        'description',
        'transferAmount',
        'referenceCode',
    ];
}

