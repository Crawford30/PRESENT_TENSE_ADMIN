<?php

namespace App\Http\Requests\VideoDVDRequest;

use App\VideoDVDView;
use Illuminate\Foundation\Http\FormRequest;

class SaveVideoDVDViewsRequest extends FormRequest
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
            "video_d_v_d_id" => "required"
        ];
    }

    public function save(){
        $data = [
         'user_id' => auth()->user()->id,
         'video_d_v_d_id' => ($this->video_d_v_d_id),

        ];

         $videoDVDViewsData = VideoDVDView::updateOrCreate([
             'id' => $this->id], $data);
     return apiResponse($videoDVDViewsData);

 }
}
