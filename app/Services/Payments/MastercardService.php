<?php

namespace App\Services\Payments;

use App\Models\Booking;

class MastercardService implements PaymentInterface
{
    public function process(Booking $booking, array $data): array
    {
        return [
            'success' => true,
            'transaction_id' => 'MST-' . uniqid(),
            'message' => 'Mastercard payment processed successfully.',
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
        if (empty($data['card_number'])) {
            $errors['card_number'] = 'Card number is required.';
        } elseif (!preg_match('/^\d{16}$/', preg_replace('/\s/', '', $data['card_number']))) {
            $errors['card_number'] = 'Invalid card number.';
        }
        if (empty($data['expiry'])) {
            $errors['expiry'] = 'Expiry date is required.';
        } elseif (!preg_match('/^\d{2}\/\d{2}$/', $data['expiry'])) {
            $errors['expiry'] = 'Invalid expiry date (MM/YY).';
        }
        if (empty($data['cvv'])) {
            $errors['cvv'] = 'CVV is required.';
        } elseif (!preg_match('/^\d{3,4}$/', $data['cvv'])) {
            $errors['cvv'] = 'Invalid CVV.';
        }
        if (empty($data['cardholder_name'])) {
            $errors['cardholder_name'] = 'Cardholder name is required.';
        }
        return $errors;
    }
}