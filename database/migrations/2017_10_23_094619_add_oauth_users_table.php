<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOauthUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oauth_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('oauth_id');
            $table->string('access_token');
            $table->string('refresh_token');
            $table->integer('oauth_driver_id');
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
        Schema::dropIfExists('oauth_users');
    }
}
