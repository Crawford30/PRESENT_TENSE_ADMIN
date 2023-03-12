<?php

namespace App\Http\Requests\BigSongBookRequest;

use App\BigSongBookSongs;
use Illuminate\Foundation\Http\FormRequest;

class DeleteBigSongBookSongsRequest extends FormRequest
{
    public function authorize()
    {

        return true;
    }

    public function rules()
    {
        return [
            "big_song_book_id" => "required"
        ];
    }


    public function delete()
    {
        $grant= BigSongBookSongs::findOrFail($this->big_song_book_id);
        $grant->delete();
        return response()->json("DELETED", 200);
    }
}
