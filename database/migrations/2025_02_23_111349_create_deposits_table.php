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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('currency_type');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('admin_address')->nullable();
            $table->decimal('amount', 16, 8);
            $table->decimal('fees', 16, 8)->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('admin_transaction_id')->nullable();
            $table->integer('confirmations')->default(0);
            $table->enum('status', ['pending', 'confirmed', 'failed'])->default('pending');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposits');
    }
};
