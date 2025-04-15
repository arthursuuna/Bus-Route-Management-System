<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('conductors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('bus_id')->nullable()->constrained('buses')->onDelete('set null');
            $table->string('employee_number')->unique();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('conductors');
    }
};