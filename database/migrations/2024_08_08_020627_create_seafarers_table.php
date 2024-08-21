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
        Schema::create('seafarers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('job_id')->constrained()->cascadeOnDelete();
            $table->string('formatted_id')->unique();
            $table->enum('status', ['new', 'on_boarding', 'active', 'inactive']);
            $table->string('fullname');
            $table->string('seaman_book');
            $table->string('seaman_book_place');
            $table->string('issue_date');
            $table->string('nationality');
            $table->string('religion');
            $table->string('dob');
            $table->float('weight');
            $table->string('height');
            $table->integer('overall_size');
            $table->string('mobile_no');
            $table->string('email');
            $table->string('next_of_kin');
            $table->string('relationship');
            $table->string('next_of_kin_mobile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seafarers');
    }
};
