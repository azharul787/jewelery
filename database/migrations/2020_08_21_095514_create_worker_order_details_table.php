<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('worker_order_id')->unsigned();
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('order_detail_id')->unsigned()->nullable();
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('caret_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('order_no');
            $table->decimal('weight',10,2);
            $table->decimal('wage',10,2);
            $table->date('order_date');
            $table->date('delivery_date');
            $table->string('status')->default('Pending');
            $table->date('deliveried_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_detail_id')->references('id')->on('order_details')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('worker_order_id')->references('id')->on('worker_orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('caret_id')->references('id')->on('carets')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('worker_order_details');
    }
}
