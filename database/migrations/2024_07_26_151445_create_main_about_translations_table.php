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
        Schema::create('main_about_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_about_id');
            $table->string('locale')->index();
            $table->text('description');

            $table->unique(['main_about_id', 'locale']);
            $table->foreign('main_about_id')->references('id')->on('main_abouts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_about_translations');
    }

};
