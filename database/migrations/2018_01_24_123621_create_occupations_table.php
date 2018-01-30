<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOccupationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupations', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->string('organization');
            $table->string('position');
            $table->decimal('start_year', 4, 0);
            $table->decimal('end_year', 4, 0)->nullable();
            $table->text('testimonial')->nullable();
            $table->timestamps();
        });
        Schema::table('occupations', function (Blueprint $table) {
            $table->integer('alumni_id')->unsigned();
            $table->foreign('alumni_id')->references('id')->on('alumni')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('occupations', function (Blueprint $table) {
            $table->dropForeign(['alumni_id']);
            $table->dropColumn(['alumni_id']);
            $table->dropIfExists();
        });
    }
}
