<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWrequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wrequests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tran_id')->unsigned();
            $table->boolean('status')->default(false);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('tran_id')->references('id')->on('trans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wrequests');
    }
}
