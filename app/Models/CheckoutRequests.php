<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutRequests extends Model
{
    use HasFactory;
    protected $table = 'checkOutRequests';
    protected $fillable = [
        "msisdn","amount","overallstatus","overallstatusHistory"," merchantRequestID ","checkoutRequestID","metadata"
    ];

}
