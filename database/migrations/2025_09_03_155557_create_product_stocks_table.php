<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('location', ['toko','gudang']);
            $table->integer('qty')->default(0);
            $table->timestamps();

            $table->unique(['product_id','location'], 'uniq_product_location');
        });
    }
    public function down(): void {
        Schema::dropIfExists('product_stocks');
    }
};
