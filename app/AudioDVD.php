<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioDVD extends Model
{

    protected $fillable = [
        'creator_user_id', 'audio_dvd_name', 'audio_dvd_path','creation_date'
    ];


    public function audioDVDViews(){
        return $this->hasMany(AudioDVDView::class);
    }

}