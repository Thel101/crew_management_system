<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \DB::statement("
            CREATE OR REPLACE VIEW job_views AS
            SELECT
                v.name AS vessel_name,
                r.name AS role_name,
                j.id AS job_id,
                j.count AS head_count,
                j.joining_date,
                j.port,
                j.basic_salary
            FROM jobs j
            JOIN vessels v ON j.vessel_id = v.id
            JOIN roles r ON j.role_id = r.id
            GROUP BY v.name, r.name, j.id, j.count, j.joining_date, j.port, j.basic_salary
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \DB::statement("DROP VIEW IF EXISTS job_views");
    }
};
