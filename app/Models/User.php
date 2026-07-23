<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rating;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_paused',
        'num1',
        'num2',
        'discount',
        'points',
        ];

    protected function casts(): array
    {
        return [
            'is_paused' => 'boolean',
            'discount' => 'decimal:2',
            'points' => 'integer',
        ];
    }

    protected $hidden = ['password'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function averageRating()
    {
        $tripIds = $this->trips()->pluck('id');
        return Rating::whereIn('trip_id', $tripIds)->avg('rating');
    }

    public function pointTransactions()
    {
        return $this->hasMany(PointTransaction::class);
    }

    public function ratingCount()
    {
        $tripIds = $this->trips()->pluck('id');
        return Rating::whereIn('trip_id', $tripIds)->count();
    }
}
