<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('help_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('help_group_id')->constrained()->onDelete('cascade');
            $table->string('question');
            $table->text('answer');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('help_entries');
    }
};
