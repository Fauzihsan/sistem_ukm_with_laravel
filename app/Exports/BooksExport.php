<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class BooksExport implements FromArray, WithHeadings, ShouldAutoSize, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array():array
    {
        return Book::getDataBooks();
    }

    public function headings():array{
        return[
            'No',
            'Judul',
            'Penulis',
            'Tahun',
            'Penerbit',
        ];
    }

    //Mengganti nama worksheetnya
    // public function title():string{
    //     return 'Data Buku';
    // }
}
