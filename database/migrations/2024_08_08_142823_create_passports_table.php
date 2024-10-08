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
        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seafarer_id')->constrained()->cascadeOnDelete();
            $table->string('passport_no');
            $table->string('place_of_issue');
            $table->string('issue_date');
            $table->string('expiry_date');
            $table->enum('status', ['active', 'warning', 'expired']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passports');
    }
};
