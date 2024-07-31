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
        if(!Schema::hasTable('carts')){
            Schema::create('carts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('customer_id');
                $table->decimal('total_price');
                $table->timestamps();

                $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
