<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('payment_date')->useCurrent();
            $table->decimal('amount', 12, 2);
            $table->enum('method', ['tunai','transfer','qris'])->default('tunai');
            $table->foreignId('received_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->string('notes', 255)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('payments');
    }
};
