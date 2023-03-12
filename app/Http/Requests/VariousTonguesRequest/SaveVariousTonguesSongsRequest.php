<?php

namespace App\Http\Requests\VariousTonguesRequest;

use App\SongsInVariousTongues;
use Illuminate\Foundation\Http\FormRequest;

class SaveVariousTonguesSongsRequest extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'song_number'=>'required',
            'song_title' =>'required',
            'song_body' =>'required'

        ];
    }

    public function saveSong($request){
           $data = [
            'song_number' => strip_tags($request->song_number),
            'user_id' => auth()->user()->id,
            'song_title' => strip_tags($request->song_title),
            'song_body' => ($request->song_body),
           ];

            $songData = SongsInVariousTongues::updateOrCreate([
                'id' => $request->song_id], $data);
        return apiResponse($songData);

    }
}
