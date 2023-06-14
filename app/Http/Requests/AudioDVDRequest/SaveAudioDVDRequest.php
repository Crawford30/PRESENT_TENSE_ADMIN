<?php

namespace App\Http\Requests\AudioDVDRequest;

use App\AudioDVD;
use Illuminate\Foundation\Http\FormRequest;

class SaveAudioDVDRequest extends FormRequest
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
            "audio_dvd_name" => "required",
            "creation_date" => "required",
            "file" => "required"
        ];
    }




    public function save(){
        if ($this->has('audio_id') && $this->audio_id != NULL) {

            $audio = AudioDVD::find($this->audio_id);
            $audio->update([
                "audio_dvd_name" => $this->audio_dvd_name,
                "creation_date" => $this->creation_date,
                "creator_user_id" => auth()->user()->id,

            ]);

            $audio_dvd_path = $this->storeAudio();

            if ($audio_dvd_path) {
                $audio->update([
                    "audio_dvd_path" => $audio_dvd_path,
                ]);
            }
        } else {
            $audio = AudioDVD::create([
                "audio_dvd_name"=> $this->audio_dvd_name,
                "audio_dvd_path"=> $this->storeAudio(),
                "creator_user_id" => auth()->user()->id,
                "creation_date" => $this->creation_date,
            ]);
        }

        return apiResponse($audio);
    }


    private function storeAudio() {

        if($this->hasFile('file')){
            // $file = storeFile('/presenttense/audiodvds/', $this->file, "audio");
            $file = storeFile('/presenttense/audiodvds/', $this->file, "audio");
            $fileToStore = $file->file_path;
        } else {
            $fileToStore = null;
        }
        return $fileToStore;
    }

}
