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
        $driver = Schema::getConnection()->getDriverName();

        // Add image_mime column
        if (!Schema::hasColumn('reports', 'image_mime')) {
            Schema::table('reports', function (Blueprint $table) {
                $table->string('image_mime')->nullable();
            });
        }

        // Add image_data column with proper large binary type
        if (!Schema::hasColumn('reports', 'image_data')) {
            if ($driver === 'pgsql') {
                DB::statement('ALTER TABLE reports ADD COLUMN image_data BYTEA NULL');
            } else {
                DB::statement('ALTER TABLE reports ADD COLUMN image_data LONGBLOB NULL');
            }
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
