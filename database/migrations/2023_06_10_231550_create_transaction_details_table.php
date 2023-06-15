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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id('transaction_detail_id');
            $table->unsignedBigInteger('tf_id');
            $table->foreign('tf_id')->references('tf_id')->on('transactions')->onDelete('cascade');
            $table->unsignedBigInteger('ticket_category_id');
            $table->foreign('ticket_category_id')->references('ticket_category_id')->on('ticket_categories')->onDelete('cascade');
            $table->integer('amount_ticket')->nullable();
            $table->integer('total_ticket')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_details');
    }
};
