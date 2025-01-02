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
        Schema::create('ride_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('ride_requests');
            $table->foreignId('passenger_id')->constrained('passengers');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->string('start_location');
            $table->string('end_location');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('status');
            $table->integer('price');
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ride_histories');
    }
};
