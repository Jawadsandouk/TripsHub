<?php

namespace App\Services\Payments;

use App\Models\Booking;

interface PaymentInterface
{
    public function process(Booking $booking, array $data): array;
    public function callback(array $request): array;
    public function validate(array $data): array;
}