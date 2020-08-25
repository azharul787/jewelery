<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('incometype_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->date('income_date');
            $table->decimal('income_amount',10,2);
            $table->string('description')->nullable();
            $table->foreign('incometype_id')->references('id')->on('incometypes')->onDelete('cascade')->onUpdate('cascade'); 
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
        Schema::dropIfExists('incomes');
    }
}
