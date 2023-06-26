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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->datetime('start_time');
            $table->datetime('finish_time');
            $table->longText('comments')->nullable();
            $table->string('client_email');
            $table->foreignId('employee_id')->constrained('users');
            $table->string('payment_status')->default('unpaid');
            $table->string('payment_intent_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
