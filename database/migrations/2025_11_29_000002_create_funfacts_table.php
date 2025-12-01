<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('funfacts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('category');
            $table->string('summary');
            $table->string('img')->nullable();
            $table->string('source')->nullable();
            $table->string('author')->nullable();
            $table->string('date')->nullable();
            $table->text('content');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('funfacts');
    }
};
