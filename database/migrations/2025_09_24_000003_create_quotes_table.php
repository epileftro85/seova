<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->uuid('reference')->unique();
            $table->string('name', 120);
            $table->string('email', 160);
            $table->string('website', 255)->nullable();
            $table->string('budget', 50);
            $table->string('goal', 60);
            $table->text('message')->nullable();
            $table->boolean('consent')->default(false);
            $table->string('status', 30)->default('new');
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
