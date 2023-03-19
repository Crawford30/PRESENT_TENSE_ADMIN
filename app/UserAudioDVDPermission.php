<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAudioDVDPermission extends Model
{

    protected $fillable = [
        'audio_d_v_d_id', 'permission'
    ];

}
