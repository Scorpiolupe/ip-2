<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ride_requests', function (Blueprint $table) {
            $table->id();
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->string('pickup_time');
            $table->integer('passenger_count');
            $table->text('special_requests')->nullable();
            $table->foreignId('passenger_id')->constrained('users');
            $table->foreignId('driver_id')->nullable()->constrained('drivers');
            $table->string('completed_at')->nullable();
            $table->string('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ride_requests');
    }
};