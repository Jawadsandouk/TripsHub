<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            // Basic trip info
            $table->string('place_name');
            $table->decimal('seat_price', 10, 2);
            $table->string('duration');
            $table->enum('food_policy', ['Allowed', 'Not Allowed'])->default('Not Allowed');

            // New fields you want to add
            $table->integer('available_seats');
            $table->dateTime('departure_time');
            $table->string('meeting_point')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['open', 'closed', 'canceled', 'finished'])->default('open');
            $table->string('trip_type')->nullable();
            $table->string('image')->nullable();

            // Office (user) who created the trip
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
