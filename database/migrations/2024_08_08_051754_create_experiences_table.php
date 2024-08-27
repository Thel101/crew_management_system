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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seafarer_id')->constrained()->cascadeOnDelete();
            $table->string('ship_name');
            $table->string('flag');
            $table->string('ship_type');
            $table->string('rank');
            $table->string('GRT');
            $table->string('trade');
            $table->string('sign_on_date');
            $table->string('sign_off_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
