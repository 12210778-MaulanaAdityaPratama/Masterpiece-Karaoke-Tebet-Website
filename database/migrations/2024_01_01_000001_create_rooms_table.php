<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');                         // "Room VIP Sakura"
            $table->enum('type', ['small','medium','large','vip'])->default('medium');
            $table->integer('capacity_min')->default(2);
            $table->integer('capacity_max')->default(6);
            $table->decimal('price_weekday', 10, 2);        // harga per jam weekday
            $table->decimal('price_weekend', 10, 2);        // harga per jam weekend
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->json('facilities')->nullable();         // ["LED TV 55\"","Sofa Premium",...]
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
