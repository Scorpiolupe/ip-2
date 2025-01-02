<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->string('profile_photo_url', 500)->nullable();
            $table->string('experience_years')->default(0);
            $table->string('vehicle_model');
            $table->string('vehicle_license_plate');
            $table->string('license')->nullable();
            $table->string('registration');
            $table->string('bio')->nullable();
            $table->string('tel');
            $table->string('created_at')->nullable();
            $table->string('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
