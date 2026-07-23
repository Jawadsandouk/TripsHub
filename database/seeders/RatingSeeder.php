<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $ali = User::where('email', 'Ali@user.com')->first();
        $ahmad = User::where('email', 'Ahmad@user.com')->first();
        $noor = User::where('email', 'Noor@user.com')->first();
        $sedra = User::where('email', 'sawansoso881@gmail.com')->first();
        $jawad = User::where('email', 'jawad.sandouk.03@gmail.com')->first();

        $ratings = [
            ['user_id' => $noor->id, 'trip_id' => 6, 'rating' => 5, 'comment' => 'Fantastic! The guide was very helpful.'],
            ['user_id' => $ali->id, 'trip_id' => 1, 'rating' => 5, 'comment' => 'Amazing tour of Old Damascus!'],
            ['user_id' => $jawad->id, 'trip_id' => 1, 'rating' => 4, 'comment' => 'Very nice tour'],
            ['user_id' => $sedra->id, 'trip_id' => 1, 'rating' => 5, 'comment' => 'أجمل رحلة في دمشق القديمة'],
            ['user_id' => $noor->id, 'trip_id' => 1, 'rating' => 5, 'comment' => 'رحلة مميزة'],
            ['user_id' => $ahmad->id, 'trip_id' => 2, 'rating' => 4, 'comment' => 'Great hiking experience'],
            ['user_id' => $ali->id, 'trip_id' => 2, 'rating' => 5, 'comment' => 'Excellent multi-stop tour!'],
            ['user_id' => $jawad->id, 'trip_id' => 2, 'rating' => 4, 'comment' => 'Good trip overall'],
            ['user_id' => $sedra->id, 'trip_id' => 2, 'rating' => 5, 'comment' => 'أفضل رحلة قمت بها'],
            ['user_id' => $noor->id, 'trip_id' => 2, 'rating' => 5, 'comment' => 'استمتعت كثيراً'],
        ];

        foreach ($ratings as $rating) {
            Rating::create($rating);
        }
    }
}
