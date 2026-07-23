<?php

namespace App\Mail;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class BookingTicketMail extends Mailable
{
    public Booking $booking;
    public Payment $payment;
    public string $ticketEmail;

    public function __construct(Booking $booking, Payment $payment, string $ticketEmail)
    {
        $this->booking = $booking;
        $this->payment = $payment;
        $this->ticketEmail = $ticketEmail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Your Trip Booking Confirmation'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-ticket',
            with: [
                'logoUrl' => asset('images/logo1.png'),
            ],
        );
    }
}
