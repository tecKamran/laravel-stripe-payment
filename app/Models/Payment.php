<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_email',
        'stripe_charge_id',
        'amount',        // store integer cents or whole currency unit consistently
        'currency',
        'status',
    ];

    protected $casts = [
        'amount' => 'integer',
    ];
}
