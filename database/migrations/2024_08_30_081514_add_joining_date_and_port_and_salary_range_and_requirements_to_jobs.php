<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->after('count', function($table){
                $table->string('joining_date');
                $table->string('port');
                $table->integer('basic_salary')->default(0);
                $table->string('requirements');
            });

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('joining_date');
            $table->dropColumn('port');
            $table->dropColumn('basic_salary');
            $table->dropColumn('requirements');
        });
    }
};
