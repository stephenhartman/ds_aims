<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {

           $table->increments('id');
           $table->string('title');
           $table->text('type');
           $table->dateTime('start_date');
           $table->dateTime('end_date');
           $table->text('location');
           $table->integer('repeats');
           $table->integer('repeat_freq');
           $table->dateTime('repeat_until');
           $table->text('description');
            $table->softDeletes();
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
        Schema::dropIfExists('events');
    }
}
