<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('player_cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 👈 juiste relatie naar users
            $table->string('username')->nullable();
            $table->date('birthday')->nullable();
            $table->string('profile_picture')->nullable();
            $table->text('about')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('player_cards');
    }
};
