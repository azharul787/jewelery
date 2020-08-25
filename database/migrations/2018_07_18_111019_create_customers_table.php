<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('distric_id')->unsigned()->nullable();
            $table->integer('upozila_id')->unsigned()->nullable();
            $table->integer('union_id')->unsigned()->nullable();
            $table->integer('village_id')->unsigned()->nullable();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_email')->nullable();
            $table->string('customer_address')->nullable();
            $table->foreign('distric_id')->references('id')->on('districs')->onDelete('cascade')->onUpdate('cascade');  
            $table->foreign('upozila_id')->references('id')->on('upozilas')->onDelete('cascade')->onUpdate('cascade');  
            $table->foreign('union_id')->references('id')->on('unions')->onDelete('cascade')->onUpdate('cascade');  
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade')->onUpdate('cascade');  
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
        Schema::dropIfExists('customers');
    }
}
