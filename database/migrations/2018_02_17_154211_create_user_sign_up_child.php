<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSignUpChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sign_ups', function(Blueprint $table){
           $table->increments('id');
           $table->integer('user_id');
           $table->integer('event_id');
           $table->integer('child_id');
           $table->integer('number_attending');
           $table->text('notes')->nullable();
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
        Schema::dropIfExists('sign_ups');
    }
}
