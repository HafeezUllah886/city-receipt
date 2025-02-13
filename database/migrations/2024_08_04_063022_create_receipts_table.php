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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->date('date');
            $table->string('consultant')->nullable();
            $table->string('pName');
            $table->string('contact')->nullable();
            $table->string('cnic')->nullable();
            $table->string('gender');
            $table->foreignId('userID')->constrained('users', 'id');
            $table->enum('refunded', ['yes', 'no'])->default('no');
            $table->string('refundedBy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
