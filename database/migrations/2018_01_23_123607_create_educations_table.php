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
        Schema::table('educations', function (Blueprint $table) {
            $table->integer('id')->unsigned();
            $table->integer('alumni_id')->unsigned();
            $table->foreign('alumni_id')->references('id')->on('alumni')->onDelete('cascade');
            $table->string('school');
            $table->string('location');
            $table->decimal('start_year', 4, 0);
            $table->decimal('end_year', 4, 0)->nullable();
            $table->text('testimonial')->nullable();
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
        Schema::table('educations', function (Blueprint $table) {
            $table->dropForeign(['alumni_id']);
            $table->dropColumn(['alumni_id']);
            $table->dropIfExists();
        });
    }
}
