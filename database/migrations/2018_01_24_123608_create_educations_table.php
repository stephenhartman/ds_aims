<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('diploma');
            $table->string('school');
            $table->string('location');
            $table->decimal('start_year', 4, 0);
            $table->decimal('end_year', 4, 0)->nullable();
            $table->text('testimonial')->nullable();
            $table->boolean('share')->default(0);
            $table->timestamps();
        });
        Schema::table('educations', function (Blueprint $table) {
            $table->integer('alumnus_id')->unsigned();
            $table->foreign('alumnus_id')->references('id')->on('alumni')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('educations', function (Blueprint $table) {
            $table->dropForeign(['alumnus_id']);
            $table->dropColumn(['alumnus_id']);
            $table->dropIfExists();
        });
    }
}
