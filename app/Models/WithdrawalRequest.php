<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WithdrawalRequest extends Model
{
    protected $fillable = [
        'office_id',
        'amount',
        'payment_method',
        'payment_details',
        'status',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(User::class, 'office_id');
    }
}
