<?php

namespace App\Providers;

use App\Events\BookingCreated;
use App\Listeners\SendBookingTicket;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        BookingCreated::class => [
            SendBookingTicket::class,
        ],
    ];
}
