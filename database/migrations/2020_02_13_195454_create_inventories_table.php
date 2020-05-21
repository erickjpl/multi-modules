<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('arrival');
            $table->dateTime('due_date');
            $table->enum('product_presentation', ['kilo','gramo','litro','mililitros','unidad']);
            $table->bigInteger('wholesale_quantity')->unsigned();
            $table->double('purchase_price', 10, 2);
            $table->enum('status', ['disponible', 'no disponible']);
            $table->text('observation');
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('heritage_id')->unsigned();
           
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('heritage_id')->references('id')->on('heritages')
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
        Schema::dropIfExists('inventories');
    }
}
