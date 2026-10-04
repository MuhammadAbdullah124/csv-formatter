<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('csv_mappings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->string('mapping_name')->default('default');
            $table->json('column_map');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('csv_mappings');
    }
};
