<?php

namespace App\Http\Requests\GodTenMajorRequest;

use App\GodTenMajorSongs;
use Illuminate\Foundation\Http\FormRequest;

class SaveGodTenMajorSongsRequest extends FormRequest
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
            'song_body' => strip_tags($request->song_body),
           ];

            $songData = GodTenMajorSongs::updateOrCreate([
                'id' => $request->song_id], $data);
        return apiResponse($songData);

    }
}
