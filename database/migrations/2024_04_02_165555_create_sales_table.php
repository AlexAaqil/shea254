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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->boolean('order_type');
            $table->decimal('total_amount', 10,2)->default(0.00);
            $table->decimal('discount',10,2)->default(0);
            $table->unsignedTinyInteger('payment_method')->default(0);
            $table->foreignId('payment_id');
            $table->foreignId('customer_id')->constrained('customers')->nullable();
            $table->foreignId('delivery_id')->constrained('deliveries')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
