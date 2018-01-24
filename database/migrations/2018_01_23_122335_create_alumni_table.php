<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumni', function (Blueprint $table) {
           $table->integer('id')->unsigned();
           $table->integer('user_id')->unsigned();
           $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           $table->string('first_name');
           $table->string('last_name');
           $table->integer('phone_number')->nullable();
           $table->string('social_pref')->nullable();
           $table->string('street_address')->nullable();
           $table->string('city')->nullable();
           $table->string('state')->nullable();
           $table->string('zipcode')->nullable();
           $table->decimal('year_graduated', 4, 0)->nullable();
           $table->smallInteger('loyal_lion');
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
        Schema::table('alumni', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id']);
            $table->dropifExists();
        });
    }
}
