<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE trips MODIFY COLUMN status ENUM('open', 'closed', 'canceled', 'finished', 'paused') NOT NULL DEFAULT 'open'");
        }
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE trips MODIFY COLUMN status ENUM('open', 'closed', 'canceled', 'finished') NOT NULL DEFAULT 'open'");
        }
    }
};
