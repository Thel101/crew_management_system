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
        Schema::create('cvforms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('profile_pic');
            $table->string('fullname');
            $table->string('rank');
            $table->string('nationality');
            $table->integer('expected_salary');
            $table->string('religion');
            $table->string('dob');
            $table->string('place_of_birth');
            $table->string('height');
            $table->float('weight');
            $table->integer('overall_size');
            $table->string('safety_shoe_size');
            $table->string('mobile_no');
            $table->string('email');
            $table->string('next_of_kin');
            $table->string('relationship');
            $table->string('next_of_kin_phone');
            $table->string('next_of_kin_email');
            $table->string('next_of_kin_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvforms');
    }
};
