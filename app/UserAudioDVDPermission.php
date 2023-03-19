<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAudioDVDPermission extends Model
{

    protected $fillable = [
        'audio_d_v_d_id', 'permission'
    ];

    protected $hidden = ['audio_d_v_d_s'];

    public function audioDVD()
    {
        return $this->belongsTo(AudioDVD::class);
    }

}
