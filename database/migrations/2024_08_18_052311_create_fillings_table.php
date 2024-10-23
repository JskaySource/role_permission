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
        Schema::create('fillings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date');
            $table->integer('zara_filling');
            $table->integer('refil_filling');

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('restrict')
            ->onUpdate('cascade');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }
    /**
     * The challange number.
     *
     * @var int
     */
    public int $challange_no;
    



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fillings');
    }
};
