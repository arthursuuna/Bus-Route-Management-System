<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('bus_passes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('pass_id')->unique()->nullable();
            $table->foreignId('route_id')->constrained('routes');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_renewal')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('bus_passes');
    }
};