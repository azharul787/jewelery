<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRawPurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raw_purchase_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('raw_purchase_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('caret_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->decimal('weight',10,3);
            $table->date('purchase_date');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('raw_purchase_id')->references('id')->on('raw_purchases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('caret_id')->references('id')->on('carets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('raw_purchase_details');
    }
}
