<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel paket utama — hanya nama & info umum
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');                        // "Paket Hemat"
            $table->text('description')->nullable();       // "Free Room 2 Jam"
            $table->integer('duration_hours')->default(2); // berlaku untuk semua tier
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Tier per paket — Bronze / Silver / Gold / dll
        Schema::create('package_tiers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->string('name');                        // "Bronze", "Silver", "Gold"
            $table->string('color')->default('#CD7F32');   // warna badge hex
            $table->decimal('price', 10, 2);
            $table->string('badge')->nullable();           // "Best Seller", dll
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Item/isi per tier
        Schema::create('tier_includes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_tier_id')->constrained()->onDelete('cascade');
            $table->string('item_name');                   // "Ice Lemon Tea"
            $table->string('quantity');                    // "1 Pitcher", "2 Porsi"
            $table->integer('sort_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tier_includes');
        Schema::dropIfExists('package_tiers');
        Schema::dropIfExists('packages');
    }
};
