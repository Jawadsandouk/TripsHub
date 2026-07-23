<?php

namespace App\Events;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookingCreated
{
    use Dispatchable, SerializesModels;

    public Booking $booking;
    public Payment $payment;
    public string $ticketEmail;

    public function __construct(Booking $booking, Payment $payment, string $ticketEmail)
    {
        $this->booking = $booking;
        $this->payment = $payment;
        $this->ticketEmail = $ticketEmail;
    }
}
