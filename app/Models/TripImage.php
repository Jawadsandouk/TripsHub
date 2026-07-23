<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripImage extends Model
{
    protected $fillable = ['image_path', 'order'];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
