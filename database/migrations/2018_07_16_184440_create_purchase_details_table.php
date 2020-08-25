<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('purchase_id')->unsigned();
            $table->bigInteger('warehouse_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('supplier_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('caret_id')->unsigned();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->string('code_no');
            $table->integer('rack_no');
            $table->decimal('weight',10,2);
            $table->decimal('per_gram_price',10,2);
            $table->decimal('purchase_price',10,2);
            $table->decimal('sale_price',10,2);
            $table->integer('quantity')->unsigned();
            $table->integer('now_stock')->unsigned();
            $table->date('purchase_date');
            $table->string('note')->nullable();
            $table->integer('created_by')->nusigned()->nullable();
            $table->integer('updated_by')->nusigned()->nullable();
            $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('purchase_details');
    }
}
