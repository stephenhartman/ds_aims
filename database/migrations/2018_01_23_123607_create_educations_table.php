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
            $table->integer('milestone_id')->unsigned();
            $table->foreign('milestone_id')->references('id')->on('milestones')->onDelete('cascade');
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
            $table->dropForeign(['milestone_id']);
            $table->dropColumn(['milestone_id']);
            $table->dropIfExists();
        });
    }
}
