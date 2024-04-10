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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->string('title_uk');
            $table->string('title_en');
            $table->text('description_uk');
            $table->text('description_en');
            $table->string('poster')->nullable();
            $table->json('screenshots')->nullable();
            $table->string('youtube_trailer_id')->nullable();
            $table->unsignedInteger('release_year');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
