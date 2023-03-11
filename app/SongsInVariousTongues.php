<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongsInVariousTongues extends Model
{
    protected $fillable = [
        'user_id', 'song_number', 'song_title','song_body'
    ];
}
