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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('event_categories')->onDelete('cascade');
            $table->string('titre');
            $table->string('organisateur');
            $table->string('localisation_map')->nullable();
            $table->string('ville')->nullable();
            $table->string('commune')->nullable();
            $table->string('adresse')->nullable();
            $table->string('siteweb')->nullable();
            $table->dateTime('debut');
            $table->dateTime('fin')->nullable();
            $table->string('contact')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('image');
            $table->longText('description');
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('tweeter')->nullable();
            $table->integer('status')->default(1);
            $table->integer('validate')->default(0);
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
        Schema::dropIfExists('events');
    }
};
