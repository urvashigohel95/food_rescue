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
        Schema::create('food_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('donation_id')
            ->constrained('donations')
            ->onDelete('cascade');

            $table->string('requester_name');
            $table->string('requester_email');
            $table->integer('requested_quantity');
            $table->text('message')->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'completed'
            ])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_requests');
    }
};
