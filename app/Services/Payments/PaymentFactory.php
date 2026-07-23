<?php

namespace App\Services\Payments;

use InvalidArgumentException;

class PaymentFactory
{
    public static function make(string $method): PaymentInterface
    {
        return match ($method) {
            'syriatel_cash' => new SyriatelCashService(),
            'mtn_cash' => new MTNCashService(),
            'sham_cash' => new ShamCashService(),
            'visa' => new VisaService(),
            'mastercard' => new MastercardService(),
            default => throw new InvalidArgumentException("Unsupported payment method: {$method}"),
        };
    }

    public static function methods(): array
    {
        return [
            'syriatel_cash' => 'Syriatel Cash',
            'mtn_cash' => 'Cash Mobile',
            'sham_cash' => 'Sham Cash',
            'visa' => 'Visa',
            'mastercard' => 'Mastercard',
        ];
    }
}