<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE bookings MODIFY COLUMN payment_status VARCHAR(30) NOT NULL DEFAULT 'paid'");
        DB::statement("UPDATE bookings SET payment_status = 'paid' WHERE payment_status IN ('pending', 'processing')");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE bookings MODIFY COLUMN payment_status VARCHAR(30) NOT NULL DEFAULT 'pending'");
    }
};
