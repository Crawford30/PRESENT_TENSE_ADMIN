<?php

namespace App\Http\Requests\PraisesAndWorshipRequest;

use App\Imports\SongImport;
use Maatwebsite\Excel\Facades\Excel;
use App\PraisesAndWorshipSongs;
use Illuminate\Foundation\Http\FormRequest;

class ImportPraisesAndWorshipSongsRequest extends FormRequest
{
    private $expectedHeaders = [
        "song_number", "song_title", "song_body"
    ];


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
            "file" => "required"
        ];
    }


    public function importTemplate()
    {
        $staffDataImport = new SongImport();
        $collectionData = Excel::toCollection($staffDataImport, $this->file);

        $sheetOne = $collectionData->first();

        $headers = $sheetOne->first();
        $formattedHeader = $this->formatHeaders($headers->toArray());

        // dd( $headers);

        if(!$this->isValid($formattedHeader)) {
            return apiErrorResponse('Invalid template used');
        }
        $content = $collectionData->first()->slice(1)->values()->toArray();
        $formattedContent = $this->formatContent($content);

        return apiResponse($this->saveData($formattedContent));
    }


    private function formatHeaders(array  $headers): array
    {
        try{
            $collection = collect($headers);
            $collection = $collection->filter(function ($item) {
                return $item != null;
            })->map(function ($item){
                $item = trim($item);
                $item = str_replace(' ', '_', $item);
                $item = str_replace('.', '', $item);
                return strtolower(str_replace(' ', '_', $item));
            });

            return $collection->toArray();
        }catch (\Exception $exception) {
            return [];
        }
    }

    private function isValid(array $formattedHeaders): bool
    {
        return $formattedHeaders === $this->expectedHeaders;
    }


    private function formatContent(array $content)
    {
        $fullDataContent = [];
        for ($i =0; $i < count($content); $i++) {
            $data = [];
            for($j =0; $j < count($content[$i]); $j++) {
                if(isset($this->expectedHeaders[$j])) {
                    $data[$this->expectedHeaders[$j]] = $content[$i][$j];
                }
            }
            $fullDataContent[] = $data;
        }

        return collect($fullDataContent)->filter(function ($item, $Key){
            return $item['song_number'] != null;
        })->toArray();
    }

    private function saveData(array $formattedContent)
    {

        foreach ($formattedContent as $item) {

           $data = [
            'song_number' => $item['song_number'],
            'song_title' => $item['song_title'],
            'song_body' => $item['song_body'],
            'user_id' => auth()->user()->id
           ];


            $tenMajorData = PraisesAndWorshipSongs::updateOrCreate([
                'song_number' => $item['song_number'],
                // 'song_title' => $item['song_title'],
                // 'song_body' => $item['song_body'],
            ], $data);

        }

        return apiResponse(PraisesAndWorshipSongs::all());

    }
}
