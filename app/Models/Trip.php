<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trip extends Model
{
    protected $fillable = [
        'place_name',
        'seat_price',
        'office_discount',
        'duration',
        'food_policy',
        'available_seats',
        'departure_time',
        'meeting_point',
        'description',
        'status',
        'trip_type',
        'image',
        'latitude',
        'longitude',
        'user_id',
        'area_serviced',
        'place_name_ar',
        'meeting_point_ar',
        'description_ar',
        'place_name_en',
        'meeting_point_en',
        'description_en',
    ];

    protected $casts = [
        'office_discount' => 'float',
    ];

    public function getTranslatedName($lang = null)
    {
        $lang = $lang ?? session('locale', 'en');
        return $this->{"place_name_{$lang}"} ?? $this->place_name;
    }

    public function getTranslatedDescription($lang = null)
    {
        $lang = $lang ?? session('locale', 'en');
        return $this->{"description_{$lang}"} ?? $this->description;
    }

    public function getTranslatedMeetingPoint($lang = null)
    {
        $lang = $lang ?? session('locale', 'en');
        return $this->{"meeting_point_{$lang}"} ?? $this->meeting_point;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function stops()
    {
        return $this->hasMany(TripStop::class)->orderBy('stop_order');
    }

    public function images()
    {
        return $this->hasMany(TripImage::class)->orderBy('order');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function getDiscountPercent(): float
    {
        $global = (float) DB::table('settings')->where('key', 'global_discount')->value('value') ?? 0;
        $office = (float) ($this->user?->discount ?? 0);
        return $global + $office;
    }

    public function getOfficeDiscountPercent(): float
    {
        return (float) ($this->office_discount ?? 0);
    }

    public function hasOfficeDiscount(): bool
    {
        return $this->getOfficeDiscountPercent() > 0;
    }

    public function getTotalDiscountPercent(): float
    {
        return $this->getDiscountPercent() + $this->getOfficeDiscountPercent();
    }

    public function hasDiscount(): bool
    {
        return $this->getDiscountPercent() > 0;
    }

    public function getDiscountAmount(): float
    {
        return $this->seat_price * $this->getDiscountPercent() / 100;
    }

    public function getPriceAfterOfficeDiscount(): float
    {
        return $this->seat_price * (1 - $this->getDiscountPercent() / 100);
    }

    public function getFinalPrice(): float
    {
        $price = $this->getPriceAfterOfficeDiscount();
        $price = $price * (1 - $this->getOfficeDiscountPercent() / 100);
        return $price;
    }
}
