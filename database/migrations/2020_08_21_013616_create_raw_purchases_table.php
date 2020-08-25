<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id')->unsigned();
            $table->string('nid')->nullable();
            $table->string('old_memo_no')->nullable();
            $table->decimal('per_10_gram_price',10,3)->nullable();
            $table->decimal('per_gram_price',10,3)->nullable();
            $table->integer('less_percent')->nullable();
            $table->decimal('less_price',10,3)->nullable();
            $table->decimal('total_price',10,3)->nullable();
            $table->decimal('paid_amount',10,3)->nullable();
            $table->date('purchase_date');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('raw_purchases');
    }
}
