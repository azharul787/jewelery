<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWastageReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wastage_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_detail_id')->unsigned();
            $table->bigInteger('warehouse_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('unit_id')->unsigned();
            $table->string('model_no');
            $table->integer('rack_no');
            $table->decimal('purchase_price',10,2)->unsigned();
            $table->decimal('return_price',10,2)->unsigned();
            $table->integer('return_quantity')->unsigned();
            $table->date('return_date');
            $table->string('note')->nullable();
            $table->foreign('purchase_detail_id')->references('id')->on('purchase_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('warehouse_returns');
    }
}
