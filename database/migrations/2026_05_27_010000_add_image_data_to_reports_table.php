<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->string('image_mime')->nullable()->after('image');
        });

        // Use raw SQL for the large binary column to avoid size limits
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE reports ADD COLUMN image_data BYTEA NULL');
        } else {
            DB::statement('ALTER TABLE reports ADD COLUMN image_data LONGBLOB NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn(['image_data', 'image_mime']);
        });
    }
};
