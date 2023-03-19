<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    const STATUS_PENDING = 'PENDING';
    const STATUS_DISABLED = 'DEACTIVATED';
    const STATUS_ACTIVE = 'ACTIVATED';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','type', 'api_token', 'user_status', 'dvd_access_status', 'audio_dvd_permission', 'video_dvd_permission', 'song_access_status','is_email_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // protected $appends = ['audio_dvd_permissions'];



    // public function getAudioDVDPermissionsAttribute()
    // {
    //     return collect(UserAudioDVDPermission::where('audio', $this->id)->get())
    //                 ->map(function($d){ return $d->permission; })->values()->all();
    // }
}