<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity')->unsigned();
            $table->double('tax', 10, 2)->unsigned();
            $table->double('price', 10, 2)->unsigned();
            $table->bigInteger('promotion_id')->unsigned()->nullable();
            $table->bigInteger('billing_id')->unsigned();
            
            $table->foreign('promotion_id')->references('id')->on('promotions')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('billing_id')->references('id')->on('billings')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('billing_details');
    }
}
