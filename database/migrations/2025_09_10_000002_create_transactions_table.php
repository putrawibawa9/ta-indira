<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->date('date')->default(now());
            $table->decimal('total', 15, 2)->default(0);
            $table->enum('payment_method', ['tunai', 'kredit'])->default('tunai');
            $table->decimal('dp', 15, 2)->default(0);
            $table->enum('status', ['lunas', 'belum_lunas', 'batal'])->default('belum_lunas');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
