<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AudioDVD extends Model
{



    protected $appends = ['audio_dvd_permissions'];

    protected $fillable = [
        'creator_user_id', 'audio_dvd_name', 'audio_dvd_path','creation_date'
    ];




     public function views(){
        return $this->hasMany(AudioDVDView::class);
    }



    public function getAudioDvdPermissionsAttribute()
    {
        return collect(UserAudioDVDPermission::whereHas('audioDVD', function ($query) {
            $query->where('audio_d_v_d_id', $this->id);
        })->get())->map(function ($d) {
            return $d->permission;
        })->values()->all();
    }



}
