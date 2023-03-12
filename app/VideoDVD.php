<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoDVD extends Model
{

    protected $fillable = [
        'creator_user_id', 'video_dvd_name', 'video_dvd_path','creation_date'
    ];


    public function views(){
        return $this->hasMany(VideoDVDView::class);
    }

    // public function videoDVDViews(){
    //     return $this->hasMany(VideoDVDView::class);
    // }

}