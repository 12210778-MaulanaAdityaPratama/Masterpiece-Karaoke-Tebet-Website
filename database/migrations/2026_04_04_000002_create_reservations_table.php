<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('phone_number');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->integer('duration_hours')->default(1);
            
            // "room" atau "package"
            $table->string('service_type')->default('room');
            $table->unsignedBigInteger('service_id')->nullable();
            
            $table->text('notes')->nullable();
            
            // Status booking di admin panel
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
