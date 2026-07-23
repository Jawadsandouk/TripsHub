<?php

namespace App\Services\Payments;

use App\Models\Booking;

class SyriatelCashService implements PaymentInterface
{
    public function process(Booking $booking, array $data): array
    {
        return [
            'success' => true,
            'transaction_id' => 'SYR-' . uniqid(),
            'message' => 'Syriatel Cash payment processed successfully.',
        ];
    }

    public function callback(array $request): array
    {
        return [
            'success' => true,
            'transaction_id' => $request['transaction_id'] ?? null,
        ];
    }

    public function validate(array $data): array
    {
        $errors = [];
        if (empty($data['phone'])) {
            $errors['phone'] = 'Phone number is required.';
        } elseif (!preg_match('/^(093|094|095|096)\d{7}$/', $data['phone'])) {
            $errors['phone'] = 'Invalid Syriatel phone number.';
        }
        if (empty($data['pin'])) {
            $errors['pin'] = 'PIN is required.';
        }
        return $errors;
    }
}