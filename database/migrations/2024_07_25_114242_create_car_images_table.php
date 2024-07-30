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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('car_type_id');
            $table->unsignedBigInteger('car_model_id');
            $table->unsignedBigInteger('car_color_id');
            $table->string('plate_type');
            $table->BigInteger('manufacturing_year');
            $table->string('numbers');
            $table->string('plate_letters');
            $table->date('form_expiration');
            $table->date('insurance_expiration');
            $table->string('form_serial_number');
            $table->string('status')->default('accept');
            $table->timestamps();
        });

        Schema::create('car_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->string('form_image');
            $table->string('Insurance_image');
            $table->string('delegation_image');
            $table->string('Front_image');
            $table->string('back_image');
            $table->string('the_lift_side_image');
            $table->string('the_righ_side_image');
            $table->string('front_seat_image');
            $table->string('back_seat_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_images');
        Schema::dropIfExists('cars');
    }
};
