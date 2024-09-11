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
            $table->after('sign_off', function ($table) {
                $table->enum('remark_type', ['compliment', 'comment', 'punishment', 'ban'])->nullable();
                $table->string('comment')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seafarers', function (Blueprint $table) {

            $table->dropColumn('remark_type');
            $table->dropColumn('comment');
        });
    }
};
