<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sale_id')->unsigned();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('purchase_detail_id')->unsigned()->nullable();
            $table->bigInteger('order_detail_id')->unsigned()->nullable();
            $table->bigInteger('warehouse_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('caret_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->decimal('weight',10,2)->unsigned();
            $table->integer('quantity')->unsigned();
            $table->integer('return_qty')->nullable();
            $table->string('rack_no');
            $table->decimal('unit_price',10,2)->unsigned();
            $table->decimal('discount',10,2)->unsigned()->nullable();
            $table->date('sale_date');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('purchase_detail_id')->references('id')->on('purchase_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_detail_id')->references('id')->on('order_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('caret_id')->references('id')->on('carets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sale_details');
    }
}
