<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeDeletionRequest extends Model
{
    protected $fillable = [
        'user_id',
        'office_name',
        'email',
        'num1',
        'num2',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
