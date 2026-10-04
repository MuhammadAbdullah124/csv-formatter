<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('sku')->nullable();
            $table->string('product_name');
            $table->integer('quantity')->default(0);
            $table->decimal('price', 12, 2)->default(0);
            $table->string('location_id')->nullable();
            $table->string('barcode')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['store_id', 'sku']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
