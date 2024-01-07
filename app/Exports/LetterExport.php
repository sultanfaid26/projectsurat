<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Letter;
use Carbon\Carbon;

class LetterExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Letter::get();
    }

    public function headings() : array
    {
        return[
            "id " , "Tipe", "Perihal", "peserta", "konten", "lampiran", "notulis", "dibuat", "diubah"
        ];
    }

    public function map($item) : array
    {

       return [
            $item->id,
            $item->letter_type_id,
            $item->letter_perihal,
            $item->recipients,
            $item->content,
            $item->attachment,
            $item->notulis,
            $item->created_at,
            $item->updated_at,
       ];
    }


}
