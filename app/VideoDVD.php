<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoDVD extends Model
{
    protected $appends = ['video_dvd_permissions'];

    protected $fillable = [
        'creator_user_id', 'video_dvd_name', 'video_dvd_path','creation_date'
    ];


    public function views(){
        return $this->hasMany(VideoDVDView::class);
    }

    public function getVideoDvdPermissionsAttribute()
    {
        return collect(UserVideoDVDPermission::whereHas('videoDVD', function ($query) {
            $query->where('video_d_v_d_id', $this->id);
        })->get())->map(function ($d) {
            return $d->permission;
        })->values()->all();
    }
}
