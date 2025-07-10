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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title', 150);
            $table->string('subtitle');
            $table->string('image');
            $table->enum('btn_first', [0, 1])->default(1);
            $table->string('btn_first_title', 100)->nullable();
            $table->string('btn_first_url')->nullable();
            $table->enum('btn_second', [0, 1])->default(1);
            $table->string('btn_second_title', 100)->nullable();
            $table->string('btn_second_url')->nullable();
            $table->enum('statut', [0, 1])->default(1);
            $table->string('created_by', 150);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
