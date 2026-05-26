<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Fix image_data column type if it was created with wrong size.
     */
    public function up(): void
    {
        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'pgsql') {
            // PostgreSQL BYTEA is already unlimited, but ensure column exists with correct type
            DB::statement('ALTER TABLE reports ALTER COLUMN image_data TYPE BYTEA USING image_data::BYTEA');
        } else {
            // MySQL: change from BLOB (64KB) to LONGBLOB (4GB)
            DB::statement('ALTER TABLE reports MODIFY COLUMN image_data LONGBLOB NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed
    }
};
