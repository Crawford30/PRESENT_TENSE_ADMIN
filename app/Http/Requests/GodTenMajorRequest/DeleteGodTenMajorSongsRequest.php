<?php

namespace App\Http\Requests\GodTenMajorRequest;

use App\GodTenMajorSongs;
use Illuminate\Foundation\Http\FormRequest;

class DeleteGodTenMajorSongsRequest extends FormRequest
{

    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            "ten_major_id" => "required"
        ];
    }


    public function delete()
    {
        $grant= GodTenMajorSongs::findOrFail($this->ten_major_id);
        $grant->delete();
        return response()->json("DELETED", 200);
    }
}
