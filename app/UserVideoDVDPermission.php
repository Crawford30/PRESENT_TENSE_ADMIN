<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVideoDVDPermission extends Model
{
    protected $fillable = [
        'video_d_v_d_id', 'permission'
    ];

    protected $hidden = ['video_d_v_d_s'];

    public function videoDVD()
    {
        return $this->belongsTo(VideoDVD::class);
    }
}
