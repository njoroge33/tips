<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'MSISDN',
        'businessNumber',
        'receiptNumber',
        'accountNumber',
        'amount',
        'customerName',
        'metadata',
        'org_balance'
    ];
}
