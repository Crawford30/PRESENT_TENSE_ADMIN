<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioDVDView extends Model
{
    protected $fillable =[
        "audio_dvd_id",
        "user_id"
    ];
}
