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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('dealer_id');

            $table->string('invoice_number', 50);
            $table->date('delivery_date');
            $table->string('full_qty', 50);
            $table->string('empty_qty', 50);
            $table->string('remark', 50);

            $table->foreign('user_id')->references('id')->on('users')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('invoice_id')->references('id')->on('invoices')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('product_id')->references('id')->on('products')
                ->cascadeOnUpdate()->restrictOnDelete();
            $table->foreign('dealer_id')->references('id')->on('dealers')
                ->cascadeOnUpdate()->restrictOnDelete();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery');
    }
};
