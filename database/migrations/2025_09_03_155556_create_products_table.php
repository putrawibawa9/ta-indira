<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
            Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('description')->nullable();
        $table->integer('stock')->default(0);
        $table->decimal('price', 15, 2);
        $table->unsignedBigInteger('supplier_id')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();

        $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
    });
    }

    public function down(): void {
        Schema::dropIfExists('products');
    }
};
