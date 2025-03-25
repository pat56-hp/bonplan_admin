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
        Schema::create('etablissements', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('ville');
            $table->string('adresse')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('image');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->integer('status')->default(1);
            $table->integer('validate')->default(0);
            $table->text('description');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->string('created_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('etablissements');
    }
};
