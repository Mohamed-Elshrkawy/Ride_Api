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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->json('start_location');
            $table->json('end_location');
            $table->timestamp('start_time')->nullable();
            $table->timestamp('end_time')->nullable();
            $table->decimal('distance', 8, 2);
            $table->decimal('price', 10, 2);
            $table->string('status')->default('wait');
            $table->timestamps();
        });

        Schema::create('ride_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ride_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

        });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
        Schema::dropIfExists('ride_user');
    }
};
