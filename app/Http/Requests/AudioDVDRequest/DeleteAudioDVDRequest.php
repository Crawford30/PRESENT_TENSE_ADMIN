<?php

namespace App\Http\Requests\AudioDVDRequest;

use App\AudioDVD;
use App\UserAudioDVDPermission;
use Illuminate\Foundation\Http\FormRequest;

class DeleteAudioDVDRequest extends FormRequest
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
            "audio_id" => "required"
        ];
    }


    public function deleteAudio()
    {
        $dvd= AudioDVD::findOrFail($this->audio_id);
        UserAudioDVDPermission::where("audio_d_v_d_id", $dvd->id)->delete();

        $dvd->delete();

// $dvdFile = public_path().'/'.$dvd->video_dvd_path;



// dd((file_exists($dvdFile)));

// if (file_exists($dvdFile)){
//     unlink($dvdFile);
//     $dvd->delete();
//  }







        return response()->json("DELETED", 200);
    }
}