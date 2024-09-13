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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seafarer_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('base_salary');
            $table->integer('bonus');
            $table->integer('overtime_pay');
            $table->integer('deduction');
            $table->integer('total_salary');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('payment_date')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
