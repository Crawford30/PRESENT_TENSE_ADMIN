<?php

namespace App\Http\Requests\VariousTonguesRequest;

use App\SongsInVariousTongues;
use Illuminate\Foundation\Http\FormRequest;

class DeleteVariousTonguesSongsRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            "various_tongue_song_id" => "required"
        ];
    }


    public function delete()
    {
        $grant= SongsInVariousTongues::findOrFail($this->various_tongue_song_id);
        $grant->delete();
        return response()->json("DELETED", 200);
    }
}
