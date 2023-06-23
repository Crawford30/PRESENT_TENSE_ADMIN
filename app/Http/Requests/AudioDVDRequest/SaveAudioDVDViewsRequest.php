<?php

namespace App\Http\Requests\AudioDVDRequest;

use App\AudioDVDView;
use Illuminate\Foundation\Http\FormRequest;

class SaveAudioDVDViewsRequest extends FormRequest
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
            "audio_d_v_d_id" => "required"
        ];
    }

    public function save(){
        $data = [
         'user_id' => auth()->user()->id,
         'audio_d_v_d_id' => ($this->audio_d_v_d_id),

        ];

         $audioDVDViewsData = AudioDVDView::updateOrCreate([
             'id' => $this->id], $data);
     return apiResponse($audioDVDViewsData);

 }

}
