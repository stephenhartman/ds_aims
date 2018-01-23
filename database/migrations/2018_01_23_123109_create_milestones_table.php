<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMilestonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('milestones', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('alumni_id')->unsigned();
            $table->foreign('alumni_id')->references('id')->on('alumni')->onDelete('cascade');
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
        Schema::table('milestones', function (Blueprint $table) {
            $table->dropForeign(['alumni_id']);
            $table->dropColumn(['alumni_id']);
            $table->dropifExists();
        });
    }
}
