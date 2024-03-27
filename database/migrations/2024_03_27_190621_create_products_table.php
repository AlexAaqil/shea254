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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->index();
            $table->unsignedSmallInteger('product_code')->unique()->default(0);
            $table->boolean('featured')->default(0);
            $table->text('description')->nullable();
            $table->decimal('buying_price', 10, 2)->default(0.00);
            $table->decimal('selling_price', 10, 2)->default(0.00);
            $table->decimal('discount_price', 10, 2)->default(0.00)->nullable();
            $table->unsignedSmallInteger('product_measurement')->nullable();
            $table->unsignedSmallInteger('order')->default(200);
            $table->unsignedSmallInteger('stock_count')->default(0);
            $table->unsignedSmallInteger('safety_stock')->default(0);
            $table->foreignId('category_id')->nullable()->constrained('product_categories')->onDelete('set null');
            $table->foreignId('measurement_id')->nullable()->constrained('product_measurements')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
