<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funfact_feedback', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name')->nullable();
            $table->text('comment')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funfact_feedback');
    }
};
