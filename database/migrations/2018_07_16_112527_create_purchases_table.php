<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('supplier_id')->unsigned();
            $table->integer('chalan_no')->unique();
            $table->decimal('per_10_gram_price',10,2);
            $table->decimal('per_gram_price',10,2)->nullable();
            $table->decimal('total_weight',10,2)->nullable();
            $table->decimal('total_purchase_price',10,2)->nullable();
            $table->decimal('total_quantity',10,2)->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->decimal('grand_total',10,2)->nullable();
            $table->decimal('payment',10,2)->nullable();
            $table->decimal('due_amount',10,2)->nullable();
			$table->date('purchase_date');
            $table->text('note')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
