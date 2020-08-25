<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id')->unsigned();
            $table->integer('chalan_no');
            $table->decimal('custom_cost',10,2)->nullable();
            $table->decimal('transport_cost',10,2)->nullable();
            $table->decimal('labor_cost',10,2)->nullable();
            $table->decimal('other_cost',10,2)->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('total_price',10,2)->nullable();
            $table->decimal('payment',10,2)->nullable();
            $table->date('return_date');
            $table->text('note')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_returns');
    }
}
