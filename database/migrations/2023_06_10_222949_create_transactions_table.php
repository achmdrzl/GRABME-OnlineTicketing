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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('tf_id');
            $table->string('status_payment')->default('pending');
            $table->string('order_id');
            $table->string('transaction_id')->nullable();
            $table->text('signature_key')->nullable();
            $table->dateTime('expiry_time')->nullable();
            $table->string('payment_type')->nullable();
            $table->integer('internet_tax')->nullable();
            $table->integer('total_payment')->nullable();
            $table->string('bank')->nullable();
            $table->string('va_number')->nullable();
            $table->string('permata_va_number')->nullable();
            $table->string('merchant_id')->nullable();
            $table->string('reference_id')->nullable();
            $table->enum('cetak', ['belum', 'sudah'])->default('belum');
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')->references('event_id')->on('events')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
