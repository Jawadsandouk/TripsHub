<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingTicketMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendBookingTicket
{
    public function handle(BookingCreated $event): void
    {
        Mail::to($event->ticketEmail)
            ->sendNow(new BookingTicketMail(
                $event->booking,
                $event->payment,
                $event->ticketEmail,
            ));

        Log::info('Booking ticket sent', [
            'booking_id' => $event->booking->id,
            'email' => $event->ticketEmail,
        ]);
    }
}
