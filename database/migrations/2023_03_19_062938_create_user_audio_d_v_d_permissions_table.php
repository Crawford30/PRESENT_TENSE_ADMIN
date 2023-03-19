<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAudioDVDPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_audio_d_v_d_permissions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('audio_d_v_d_id');
            $table->string('permission');
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
        Schema::dropIfExists('user_audio_d_v_d_permissions');
    }
}