<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku', 50)->unique();
            $table->string('name', 150);
            $table->string('category', 60)->nullable();
            $table->string('unit', 20)->default('pcs');
            $table->decimal('purchase_price', 12, 2)->default(0);
            $table->decimal('sell_price', 12, 2)->default(0);
            $table->unsignedInteger('min_stock')->default(0);
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();

            $table->index(['name','sku']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('products');
    }
};
