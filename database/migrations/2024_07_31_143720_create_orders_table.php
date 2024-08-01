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
        if(!Schema::hasTable('orders')){
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('customer_id');
                $table->decimal('total_price')->nullable();
                $table->enum('status',['1','2','3','4','5'])->default(1)
                    ->comment('1-accepted, 2-prepared, 3-sent, 4-delivered, 5-rejected');
                $table->timestamps();
                $table->softDeletes();

                $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
