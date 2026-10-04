<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('status')->default('active');
            $table->string('currency', 10)->default('USD');
            $table->timestamps();
        });

        Schema::create('store_user', function (Blueprint $table) {
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->primary(['store_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_user');
        Schema::dropIfExists('stores');
    }
};
