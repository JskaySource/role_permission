<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_number')->unique();
            $table->date('invoice_date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('dealer_id');

            $table->string('total', 50);
            $table->string('vat', 50);
            $table->string('discount', 50);
            $table->string('payable', 50);
            $table->string('status', 50)->default('Pending');

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('invoices');
    }
};
