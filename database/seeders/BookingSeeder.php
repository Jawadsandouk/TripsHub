<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $ali = User::where('email', 'Ali@user.com')->first();
        $ahmad = User::where('email', 'Ahmad@user.com')->first();
        $noor = User::where('email', 'Noor@user.com')->first();
        $sedra = User::where('email', 'sawansoso881@gmail.com')->first();
        $jawad = User::where('email', 'jawad.sandouk.03@gmail.com')->first();

        $trip1 = Trip::find(1);
        $trip2 = Trip::find(2);
        $trip3 = Trip::find(3);
        $trip6 = Trip::find(6);
        $trip7 = Trip::find(7);

        $bookings = [
            ['user_id' => $ali->id, 'trip_id' => $trip6->id, 'number_of_seats' => 2, 'total_price' => 76.00],
            ['user_id' => $ahmad->id, 'trip_id' => $trip6->id, 'number_of_seats' => 1, 'total_price' => 38.00],
            ['user_id' => $noor->id, 'trip_id' => $trip6->id, 'number_of_seats' => 3, 'total_price' => 114.00],
            ['user_id' => $ali->id, 'trip_id' => $trip1->id, 'number_of_seats' => 1, 'total_price' => 33.25],
            ['user_id' => $ahmad->id, 'trip_id' => $trip2->id, 'number_of_seats' => 2, 'total_price' => 47.50],
            ['user_id' => $ali->id, 'trip_id' => $trip3->id, 'number_of_seats' => 1, 'total_price' => 32.55],
            ['user_id' => $ali->id, 'trip_id' => $trip7->id, 'number_of_seats' => 1, 'total_price' => 19.00],
            ['user_id' => $jawad->id, 'trip_id' => $trip1->id, 'number_of_seats' => 1, 'total_price' => 33.25],
            ['user_id' => $jawad->id, 'trip_id' => $trip3->id, 'number_of_seats' => 1, 'total_price' => 32.55],
            ['user_id' => $jawad->id, 'trip_id' => $trip7->id, 'number_of_seats' => 1, 'total_price' => 19.00],
            ['user_id' => $sedra->id, 'trip_id' => $trip7->id, 'number_of_seats' => 1, 'total_price' => 19.00],
            ['user_id' => $sedra->id, 'trip_id' => $trip1->id, 'number_of_seats' => 1, 'total_price' => 33.25],
            ['user_id' => $sedra->id, 'trip_id' => $trip3->id, 'number_of_seats' => 1, 'total_price' => 32.55],
            ['user_id' => $noor->id, 'trip_id' => $trip1->id, 'number_of_seats' => 1, 'total_price' => 33.25],
            ['user_id' => $noor->id, 'trip_id' => $trip3->id, 'number_of_seats' => 1, 'total_price' => 32.55],
            ['user_id' => $noor->id, 'trip_id' => $trip7->id, 'number_of_seats' => 1, 'total_price' => 19.00],
            ['user_id' => $ali->id, 'trip_id' => $trip2->id, 'number_of_seats' => 1, 'total_price' => 23.75],
            ['user_id' => $jawad->id, 'trip_id' => $trip2->id, 'number_of_seats' => 1, 'total_price' => 23.75],
            ['user_id' => $sedra->id, 'trip_id' => $trip2->id, 'number_of_seats' => 1, 'total_price' => 23.75],
            ['user_id' => $noor->id, 'trip_id' => $trip2->id, 'number_of_seats' => 1, 'total_price' => 23.75],
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}
