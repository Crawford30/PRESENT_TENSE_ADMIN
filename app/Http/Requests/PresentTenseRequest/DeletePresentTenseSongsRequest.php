<?php

namespace App\Http\Requests\PresentTenseRequest;

use App\PresentTenseSongs;
use Illuminate\Foundation\Http\FormRequest;

class DeletePresentTenseSongsRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            "present_tense_id" => "required"
        ];
    }


    public function delete()
    {
        $grant= PresentTenseSongs::findOrFail($this->present_tense_id);
        $grant->delete();
        return response()->json("DELETED", 200);
    }
}
