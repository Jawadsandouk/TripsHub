<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('email', 'jawad@trips.com')->orWhere('email', 'sedra@trips.com')
            ->where('role', 'admin')->update(['role' => 'owner']);
    }

    public function down(): void
    {
        DB::table('users')->whereIn('email', ['jawad@trips.com', 'sedra@trips.com'])
            ->where('role', 'owner')->update(['role' => 'admin']);
    }
};
