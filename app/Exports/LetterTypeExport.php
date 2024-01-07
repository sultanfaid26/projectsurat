<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\LetterType;
use Carbon\Carbon;

class LetterTypeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LetterType::get();
    }

    public function headings() : array
    {
        return[
            "Kode Surat" , "Klasifikasi Surat", "Surat tertaut"
        ];
    }

    public function map($item) : array
    {
       $suratTertaut = 1;

       return [
            $item->letter_code,
            $item->name_type,
            $item->$suratTertaut,
       ];
    }


}
