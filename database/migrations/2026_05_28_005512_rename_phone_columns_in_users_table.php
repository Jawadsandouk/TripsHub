<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('mtn_phone', 'num1');
            $table->renameColumn('syr_phone', 'num2');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('num1', 'mtn_phone');
            $table->renameColumn('num2', 'syr_phone');
        });
    }
};
