<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripStop extends Model
{
    protected $fillable = [
        'trip_id',
        'place_name',
        'place_name_ar',
        'place_name_en',
        'description',
        'description_ar',
        'description_en',
        'image',
        'latitude',
        'longitude',
        'stop_duration',
        'stop_order',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function images()
    {
        return $this->hasMany(TripStopImage::class)->orderBy('order');
    }
}
