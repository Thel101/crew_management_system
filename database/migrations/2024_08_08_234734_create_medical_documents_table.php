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
        Schema::create('medical_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seafarer_id')->constrained()->cascadeOnDelete();
            $table->enum('type', ['d_c', 'vaccination', 'general']);
            $table->string('clinic');
            $table->string('document_date');
            $table->string('result')->nullable();
            $table->string('file');
            $table->enum('status', ['uploaded', 'approved', 'rejected']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_documents');
    }
};
