<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_name');
            $table->string('origin');
            $table->string('destination');
            $table->text('route_details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('routes');
    }
};