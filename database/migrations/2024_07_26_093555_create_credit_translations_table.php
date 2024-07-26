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
        Schema::create('credit_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credit_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->string('value');

            $table->unique(['credit_id', 'locale']);
            $table->foreign('credit_id')->references('id')->on('credits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credit_translations');
    }
};
