<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Your Trip Booking Confirmation') }}</title>
    <style>
        body { margin: 0; padding: 0; background-color: #1C1811; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; }
        .wrapper { max-width: 600px; margin: 0 auto; padding: 24px; }
        .ticket { background-color: #1C1811; border: 1px solid rgba(201, 169, 110, 0.15); border-radius: 20px; overflow: hidden; }
        .ticket-header { padding: 28px 28px 20px; }
        .e-ticket-label { color: rgba(184, 168, 144, 0.4); font-size: 10px; letter-spacing: 0.2em; text-transform: uppercase; }
        .ticket-id { color: #C9A96E; font-size: 12px; margin-top: 2px; font-weight: 600; }
        .brand-name { color: #C9A96E; font-size: 16px; font-weight: 900; letter-spacing: 0.08em; }
        .brand-location { color: rgba(184, 168, 144, 0.4); font-size: 9px; letter-spacing: 0.05em; }
        .gold-accent { height: 3px; background-color: #C9A96E; margin: 0 28px; border-radius: 2px; }
        .ticket-body { padding: 24px 28px; }
        .trip-name { color: #E8DEC8; font-size: 24px; font-weight: 900; margin: 0 0 2px; line-height: 1.3; }
        .trip-meta { color: rgba(184, 168, 144, 0.5); font-size: 13px; margin: 0 0 20px; }
        .info-card { background-color: rgba(201, 169, 110, 0.04); border: 1px solid rgba(201, 169, 110, 0.08); border-radius: 12px; padding: 16px 20px; margin-bottom: 16px; }
        .info-label { color: rgba(184, 168, 144, 0.4); font-size: 9px; text-transform: uppercase; letter-spacing: 0.12em; margin: 0 0 3px; }
        .info-value { color: #E8DEC8; font-size: 14px; font-weight: 600; margin: 0; }
        .meeting-box { margin-top: 12px; padding: 14px 18px; background-color: rgba(201, 169, 110, 0.05); border: 1px solid rgba(201, 169, 110, 0.08); border-radius: 10px; }
        .meeting-label { color: rgba(184, 168, 144, 0.4); font-size: 9px; text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 3px; }
        .meeting-value { color: #E8DEC8; font-size: 13px; font-weight: 500; margin: 0; }
        .divider { height: 0; border: none; border-top: 1px dashed rgba(201, 169, 110, 0.12); margin: 0; }
        .ticket-footer { padding: 20px 28px 28px; }
        .seats-text { color: #E8DEC8; font-size: 18px; font-weight: 800; margin: 0; }
        .seats-sub { color: rgba(184, 168, 144, 0.45); font-size: 14px; font-weight: normal; }
        .discount-badge { display: inline-block; background-color: rgba(74, 222, 128, 0.12); color: #4ADE80; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 4px; }
        .discount-text { color: rgba(74, 222, 128, 0.75); font-size: 12px; margin: 5px 0 0; }
        .payment-label { color: rgba(184, 168, 144, 0.4); font-size: 9px; text-transform: uppercase; letter-spacing: 0.1em; margin: 10px 0 2px; }
        .payment-value { color: rgba(184, 168, 144, 0.65); font-size: 13px; margin: 0; }
        .transaction-id { color: rgba(184, 168, 144, 0.25); font-size: 9px; margin: 4px 0 0; }
        .total-label { color: rgba(184, 168, 144, 0.4); font-size: 10px; text-transform: uppercase; letter-spacing: 0.12em; margin: 0 0 3px; }
        .total-value { color: #C9A96E; font-size: 26px; font-weight: 900; margin: 0; }
        .total-original { color: rgba(184, 168, 144, 0.3); font-size: 13px; text-decoration: line-through; margin: 2px 0 0; }
        .footer-note { text-align: center; padding: 20px 28px 28px; color: rgba(184, 168, 144, 0.6); font-size: 11px; line-height: 1.7; }
        .footer-note a { color: #C9A96E; text-decoration: none; font-weight: 600; }
        .badge-passenger { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; background-color: rgba(201, 169, 110, 0.1); color: #C9A96E; }
        .info-badge { display: inline-block; font-size: 10px; font-weight: 700; letter-spacing: 0.05em; padding: 2px 10px; border-radius: 4px; margin-bottom: 6px; }
        .info-badge-blue { background-color: rgba(74, 139, 187, 0.15); color: #6BB5E0; }
        .info-badge-gold { background-color: rgba(201, 169, 110, 0.15); color: #C9A96E; }
        .info-badge-green { background-color: rgba(74, 222, 128, 0.12); color: #4ADE80; }
        .info-badge-coral { background-color: rgba(212, 90, 106, 0.15); color: #E87A8A; }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#1C1811;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#1C1811;">
        <tr>
            <td align="center" style="padding:24px;">
                <table role="presentation" width="100%" style="max-width:600px;background-color:#1C1811;border:1px solid rgba(201,169,110,0.15);border-radius:20px;">
                    <tr>
                        <td style="padding:28px 28px 20px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}" valign="middle" width="50%">
                                        <p style="color:#C9A96E;font-size:18px;font-weight:900;letter-spacing:0.08em;margin:0 0 2px;">TRIPS HUB</p>
                                        <p style="color:rgba(184,168,144,0.4);font-size:9px;letter-spacing:0.05em;margin:0;">🚌 {{ __('Damascus') }}</p>
                                    </td>
                                    <td align="{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" valign="middle" width="50%">
                                        <p style="color:rgba(184,168,144,0.4);font-size:10px;letter-spacing:0.2em;text-transform:uppercase;margin:0 0 2px;">{{ __('e-ticket') }}</p>
                                        <p style="color:#C9A96E;font-size:12px;margin:0;font-weight:600;">#{{ strtoupper(substr(md5($booking->id . $payment->id), 0, 8)) }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr><td><div style="height:3px;background-color:#C9A96E;margin:0 28px;border-radius:2px;"></div></td></tr>

                    <tr>
                        <td style="padding:24px 28px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr><td style="padding-bottom:8px;"><span style="display:inline-block;background-color:rgba(74,139,187,0.15);color:#6BB5E0;font-size:10px;font-weight:700;letter-spacing:0.05em;padding:2px 10px;border-radius:4px;margin-bottom:6px;">❶ TRIP NAME</span></td></tr>
                                <tr><td><h1 style="color:#E8DEC8;font-size:24px;font-weight:900;margin:0 0 2px;line-height:1.3;">{{ $booking->trip->getTranslatedName() }}</h1></td></tr>
                                <tr><td><p style="color:rgba(184,168,144,0.5);font-size:13px;margin:0 0 20px;">{{ $booking->trip->user->name ?? '' }} · {{ $booking->trip->duration }}</p></td></tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:rgba(201,169,110,0.04);border:1px solid rgba(201,169,110,0.08);border-radius:12px;padding:16px 20px;margin-bottom:16px;">
                                <tr><td style="padding-bottom:8px;"><span style="display:inline-block;background-color:rgba(201,169,110,0.15);color:#C9A96E;font-size:10px;font-weight:700;letter-spacing:0.05em;padding:2px 10px;border-radius:4px;margin-bottom:6px;">❷ DEPARTURE / PASSENGER</span></td></tr>
                                <tr>
                                    <td>
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}" valign="top" width="50%">
                                                    <p style="color:rgba(184,168,144,0.4);font-size:9px;text-transform:uppercase;letter-spacing:0.12em;margin:0 0 3px;">{{ __('departure') }}</p>
                                                    <p style="color:#E8DEC8;font-size:14px;font-weight:600;margin:0;">{{ \Carbon\Carbon::parse($booking->trip->departure_time)->format('M d, Y · H:i') }}</p>
                                                </td>
                                                <td align="{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" valign="top" width="50%">
                                                    <p style="color:rgba(184,168,144,0.4);font-size:9px;text-transform:uppercase;letter-spacing:0.12em;margin:0 0 3px;">{{ __('passenger') }}</p>
                                                    <p style="color:#E8DEC8;font-size:14px;font-weight:600;margin:0;">{{ $booking->user->name }}</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:rgba(201,169,110,0.04);border:1px solid rgba(201,169,110,0.08);border-radius:12px;padding:16px 20px;margin-bottom:16px;">
                                <tr><td style="padding-bottom:8px;"><span style="display:inline-block;background-color:rgba(74,222,128,0.12);color:#4ADE80;font-size:10px;font-weight:700;letter-spacing:0.05em;padding:2px 10px;border-radius:4px;margin-bottom:6px;">❸ TRIP TYPE / STATUS</span></td></tr>
                                <tr>
                                    <td>
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}" valign="top" width="50%">
                                                    <p style="color:rgba(184,168,144,0.4);font-size:9px;text-transform:uppercase;letter-spacing:0.12em;margin:0 0 3px;">{{ __('trip type') }}</p>
                                                    <p style="color:#E8DEC8;font-size:14px;font-weight:600;margin:0;text-transform:capitalize;">{{ $booking->trip->trip_type ?? __('Trip') }}</p>
                                                </td>
                                                <td align="{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" valign="top" width="50%">
                                                    <p style="color:rgba(184,168,144,0.4);font-size:9px;text-transform:uppercase;letter-spacing:0.12em;margin:0 0 3px;">{{ __('status') }}</p>
                                                    <span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;background-color:rgba(201,169,110,0.1);color:#C9A96E;">{{ __('confirmed') }}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            @if($booking->trip->getTranslatedMeetingPoint())
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:rgba(201,169,110,0.05);border:1px solid rgba(201,169,110,0.08);border-radius:10px;padding:14px 18px;margin-top:12px;">
                                    <tr><td style="padding-bottom:6px;"><span style="display:inline-block;background-color:rgba(212,90,106,0.15);color:#E87A8A;font-size:10px;font-weight:700;letter-spacing:0.05em;padding:2px 10px;border-radius:4px;margin-bottom:6px;">❹ MEETING POINT</span></td></tr>
                                    <tr><td><p style="color:rgba(184,168,144,0.4);font-size:9px;text-transform:uppercase;letter-spacing:0.1em;margin:0 0 3px;">{{ __('meeting point') }}</p></td></tr>
                                    <tr><td><p style="color:#E8DEC8;font-size:13px;font-weight:500;margin:0;"><span style="color:#C9A96E;{{ app()->getLocale() === 'ar' ? 'margin-left' : 'margin-right' }}:4px;">📍</span> {{ $booking->trip->getTranslatedMeetingPoint() }}</p></td></tr>
                                </table>
                            @endif

                            @if($booking->trip->stops && $booking->trip->stops->count() > 0)
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:rgba(201,169,110,0.05);border:1px solid rgba(201,169,110,0.08);border-radius:10px;padding:14px 18px;margin-top:12px;">
                                    <tr><td style="padding-bottom:6px;"><span style="display:inline-block;background-color:rgba(74,139,187,0.15);color:#6BB5E0;font-size:10px;font-weight:700;letter-spacing:0.05em;padding:2px 10px;border-radius:4px;margin-bottom:6px;">❺ STOPS</span></td></tr>
                                    <tr><td><p style="color:rgba(184,168,144,0.4);font-size:9px;text-transform:uppercase;letter-spacing:0.1em;margin:0 0 3px;">{{ __('Tour Stops') }}</p></td></tr>
                                    @foreach($booking->trip->stops as $stop)
                                        <tr><td><p style="color:#E8DEC8;font-size:12px;font-weight:500;margin:3px 0 0;"><span style="color:#C9A96E;">●</span> {{ $stop->{'place_name_' . session('locale', 'en')} ?? $stop->place_name }} <span style="color:rgba(184,168,144,0.35);font-size:11px;">({{ $stop->stop_duration }}h)</span></p></td></tr>
                                    @endforeach
                                </table>
                            @endif
                        </td>
                    </tr>

                    <tr><td><hr style="border:none;border-top:1px dashed rgba(201,169,110,0.12);margin:0;"></td></tr>

                    @php
                        $discountPercent = $booking->trip->getDiscountPercent();
                        $discountAmount = $booking->trip->getDiscountAmount();
                        $seatPrice = $booking->trip->seat_price;
                        $totalBefore = $seatPrice * $booking->number_of_seats;
                        $totalAfter = $totalBefore - ($discountAmount * $booking->number_of_seats);
                    @endphp

                    <tr>
                        <td style="padding:20px 28px 28px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}" valign="top" width="50%">
                                        <span style="display:inline-block;background-color:rgba(201,169,110,0.15);color:#C9A96E;font-size:10px;font-weight:700;letter-spacing:0.05em;padding:2px 10px;border-radius:4px;margin-bottom:6px;">SEATS × PRICE</span>
                                        <p style="color:#E8DEC8;font-size:18px;font-weight:800;margin:0;">
                                            {{ $booking->number_of_seats }}
                                            <span style="color:rgba(184,168,144,0.45);font-size:14px;font-weight:normal;">&times; ${{ number_format($seatPrice, 2) }}</span>
                                        </p>
                                        @if($discountPercent > 0)
                                            <p style="margin:6px 0 0;">
                                                <span style="display:inline-block;background-color:rgba(74,222,128,0.12);color:#4ADE80;font-size:11px;font-weight:700;padding:2px 8px;border-radius:4px;">−{{ number_format($discountPercent, 0) }}%</span>
                                                <span style="color:rgba(74,222,128,0.75);font-size:12px;margin:5px 0 0;">{{ __('save') }} ${{ number_format($discountAmount * $booking->number_of_seats, 2) }}</span>
                                            </p>
                                        @endif
                                        <p style="margin-top:10px;">
                                            <span style="display:inline-block;background-color:rgba(74,222,128,0.12);color:#4ADE80;font-size:10px;font-weight:700;letter-spacing:0.05em;padding:2px 10px;border-radius:4px;margin-bottom:4px;">PAYMENT METHOD</span>
                                        </p>
                                        <p style="color:rgba(184,168,144,0.4);font-size:9px;text-transform:uppercase;letter-spacing:0.1em;margin:0 0 2px;">{{ __('payment') }}</p>
                                        <p style="color:rgba(184,168,144,0.65);font-size:13px;margin:0;">{{ __(ucwords(str_replace('_', ' ', $payment->payment_method))) }}</p>
                                        @if($payment->transaction_id)
                                            <p style="color:rgba(184,168,144,0.25);font-size:9px;margin:4px 0 0;">{{ __('Transaction') }}: {{ $payment->transaction_id }}</p>
                                        @endif
                                    </td>
                                    <td align="{{ app()->getLocale() === 'ar' ? 'left' : 'right' }}" valign="top" width="50%">
                                        <table role="presentation" cellpadding="0" cellspacing="0" style="display:inline-block;background-color:rgba(201,169,110,0.06);border:1px solid rgba(201,169,110,0.1);border-radius:10px;padding:10px 16px;">
                                            <tr><td style="padding-bottom:6px;"><span style="display:inline-block;background-color:rgba(212,90,106,0.15);color:#E87A8A;font-size:10px;font-weight:700;letter-spacing:0.05em;padding:2px 10px;border-radius:4px;margin-bottom:6px;">TOTAL</span></td></tr>
                                            <tr><td><p style="color:rgba(184,168,144,0.4);font-size:10px;text-transform:uppercase;letter-spacing:0.12em;margin:0 0 3px;">{{ __('total') }}</p></td></tr>
                                            <tr><td><p style="color:#C9A96E;font-size:26px;font-weight:900;margin:0;">${{ number_format($totalAfter, 2) }}</p></td></tr>
                                            @if($discountPercent > 0)
                                                <tr><td><p style="color:rgba(184,168,144,0.3);font-size:13px;text-decoration:line-through;margin:2px 0 0;">${{ number_format($totalBefore, 2) }}</p></td></tr>
                                            @endif
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;">
                    <tr>
                        <td align="center" style="padding:20px 28px 28px;color:rgba(184,168,144,0.6);font-size:11px;line-height:1.7;">
                            <p style="margin:0;">{{ __('Thank you for booking with') }} <strong style="color:#C9A96E;">Trips Hub</strong>!</p>
                            <p style="margin:6px 0 0;">{{ __('We hope you enjoy your trip') }} ✨</p>
                            <p style="margin:10px 0 0;">
                                <a href="{{ config('app.url') }}" style="color:#C9A96E;text-decoration:none;font-weight:600;">{{ config('app.url') }}</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>