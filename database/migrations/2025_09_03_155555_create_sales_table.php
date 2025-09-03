<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no', 40)->unique();
            $table->dateTime('sale_date')->useCurrent();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete()->cascadeOnUpdate(); // kasir
            $table->enum('payment_method', ['tunai','kredit']);
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_total', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('paid_amount', 12, 2)->default(0);
            $table->decimal('balance', 12, 2)->default(0);
            $table->date('due_date')->nullable();
            $table->enum('status', ['lunas','parsial','belum_lunas'])->default('belum_lunas');
            $table->string('notes', 255)->nullable();
            $table->timestamps();

            $table->index(['sale_date','status']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('sales');
    }
};
