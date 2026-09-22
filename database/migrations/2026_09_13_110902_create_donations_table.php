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
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->string('food_type');
            $table->integer('quantity');
            $table->string('quantity_unit')->default('plates');
            $table->text('description')->nullable();
            $table->string('pickup_location');
            $table->dateTime('available_until');
            $table->string('image')->nullable();
            
            $table->enum('status', [
                'available',
                'requested',
                'collected',
                'completed'
            ])->default('available');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
