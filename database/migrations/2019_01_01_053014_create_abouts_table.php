<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bangla_name')->nullable();
            $table->string('english_name')->nullable();
            $table->string('founder')->nullable();
            $table->date('establish_year')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('web')->nullable();
            $table->string('about')->nullable();
            $table->string('address')->nullable();
            $table->string('favicon')->nullable(); 
            $table->string('logo')->nullable(); 
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
        Schema::dropIfExists('abouts');
    }
}
