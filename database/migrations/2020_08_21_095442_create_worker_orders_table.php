<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('worker_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('caret_id')->unsigned();
            $table->integer('order_no');
            $table->decimal('gold_amount',10,2);
            $table->decimal('loss_gold',10,2)->nullable();
            $table->decimal('return_gold',10,2)->nullable();
            $table->decimal('total_wage',10,2);
            $table->decimal('payment',10,2)->nullable();
            $table->decimal('due',10,2)->nullable();
            $table->date('order_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('status')->default("Pending");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('worker_orders');
    }
}
