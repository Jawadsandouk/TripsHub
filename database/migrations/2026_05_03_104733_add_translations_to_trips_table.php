<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $columns = [
                'place_name_ar',
                'meeting_point_ar',
                'description_ar',
                'place_name_en',
                'description_en',
                'meeting_point_en',
            ];

            foreach ($columns as $col) {
                if (!Schema::hasColumn('trips', $col)) {
                    if (in_array($col, ['description_ar', 'description_en'])) {
                        $table->text($col)->nullable();
                    } else {
                        $table->string($col)->nullable();
                    }
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn(['place_name_ar', 'meeting_point_ar', 'description_ar', 'place_name_en', 'description_en', 'meeting_point_en']);
        });
    }
};