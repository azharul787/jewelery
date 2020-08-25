<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('caret_id')->unsigned();
            $table->string('order_no');
            $table->decimal('weight',10,2)->unsigned()->nullable();
            $table->decimal('wage',10,2)->unsigned()->nullable();
            $table->decimal('sub_total',10,2)->unsigned()->nullable();
            $table->decimal('lost_weight',10,2)->unsigned()->nullable();
            $table->decimal('delivery_weight',10,2)->unsigned()->nullable();
            $table->date('order_date');
            $table->date('delivery_date');
            $table->date('stock_in_date')->nullable();
            $table->string('status',20)->default('Pending');
            $table->integer('made_by')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('caret_id')->references('id')->on('carets')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('order_details');
    }
}
