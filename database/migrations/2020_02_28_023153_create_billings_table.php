<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->enum('way_paying', ['efectivo', 'cheque', 'tarjeta de credito', 'nota de credito', 'cupon']);
            $table->enum('withdraw_order', ['delibery', 'en tienda']);
            $table->enum('status', ['pendiente', 'en proceso', 'enviada', 'retirada', 'recibida', 'no procesada']);
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
