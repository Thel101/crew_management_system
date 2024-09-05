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
        Schema::table('seafarers', function (Blueprint $table) {
            $table->after('next_of_kin_mobile', function($table){
                $table->string('sign_on');
                $table->string('sign_off');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seafarers', function (Blueprint $table) {

                $table->string('sign_on');
                $table->string('sign_off');

        });
    }
};
