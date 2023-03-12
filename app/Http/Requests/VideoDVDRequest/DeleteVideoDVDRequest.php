<?php

namespace App\Http\Requests\VideoDVDRequest;

use App\VideoDVD;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\File;

class DeleteVideoDVDRequest extends FormRequest
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
            "video_id" => "required"
        ];
    }


    public function deleteVideo()
    {
        $dvd= VideoDVD::findOrFail($this->video_id);
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
