<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripStopImage extends Model
{
    protected $fillable = ['image_path', 'order'];

    public function tripStop()
    {
        return $this->belongsTo(TripStop::class);
    }
}
