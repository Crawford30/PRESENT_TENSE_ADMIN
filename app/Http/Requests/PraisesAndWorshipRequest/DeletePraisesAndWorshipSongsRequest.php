<?php

namespace App\Http\Requests\PraisesAndWorshipRequest;

use App\PraisesAndWorshipSongs;
use Illuminate\Foundation\Http\FormRequest;

class DeletePraisesAndWorshipSongsRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            "praises_and_worship_id" => "required"
        ];
    }


    public function delete()
    {
        $grant= PraisesAndWorshipSongs::findOrFail($this->praises_and_worship_id);
        $grant->delete();
        return response()->json("DELETED", 200);
    }
}
