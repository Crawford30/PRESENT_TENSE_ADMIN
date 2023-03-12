<?php

namespace App\Http\Requests\VideoDVDRequest;

use App\VideoDVD;
use Illuminate\Foundation\Http\FormRequest;

class SaveVideoDVDRequest extends FormRequest
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
            "video_dvd_name" => "required",
            "creation_date" => "required",
            "file" => "required"
        ];
    }




    public function save(){
        if ($this->has('video_id') && $this->video_id != NULL) {

            $video = VideoDVD::find($this->video_id);
            $video->update([
                "video_dvd_name" => $this->video_dvd_name,
                "creation_date" => $this->creation_date,
                "creator_user_id" => auth()->user()->id,

            ]);

            $video_path = $this->storeVideo();

            if ($video_path) {
                $video->update([
                    "video_path" => $video_path,
                ]);
            }
        } else {
            $video = VideoDVD::create([
                "video_dvd_name"=> $this->video_dvd_name,
                "video_dvd_path"=> $this->storeVideo(),
                "creator_user_id" => auth()->user()->id,
                "creation_date" => $this->creation_date,
            ]);
        }

        return apiResponse($video);
    }



    private function storeVideo() {

        if($this->hasFile('file')){
            $file = storeFile('/presenttense/videodvds/', $this->file, "video");
            $fileToStore = $file->file_path;
        } else {
            $fileToStore = null;
        }
        return $fileToStore;
    }

}
