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
        'name', 'email', 'password','type', 'api_token', 'user_status', 'dvd_access_status','song_access_status','is_email_verified', 'audio_d_v_d_id', 'video_d_v_d_id'
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

    protected $appends = ['user_audio_d_v_d_permissions'];



    public function getUserAudioDVDPermissionsAttribute()
    {
        return collect(UserAudioDVDPermission::where('audio_d_v_d_id', $this->audio_d_v_d_id)->get())
                    ->map(function($d){ return $d->permission; })->values()->all();
    }
}
