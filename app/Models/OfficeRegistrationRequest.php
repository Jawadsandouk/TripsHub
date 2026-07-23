<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeRegistrationRequest extends Model
{
    protected $fillable = [
        'office_name',
        'contact_person',
        'email',
        'num1',
        'num2',
        'latitude',
        'longitude',
        'address',
        'notes',
        'status',
    ];
}
