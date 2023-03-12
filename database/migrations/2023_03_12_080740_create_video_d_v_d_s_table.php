<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoDVDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_d_v_d_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("video_dvd_name");
            $table->integer("creator_user_id");
            $table->string("video_dvd_path")->nullable();
            $table->string('creation_date')->nullable();
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
        Schema::dropIfExists('video_d_v_d_s');
    }
}
