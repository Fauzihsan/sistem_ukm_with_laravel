<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductsExport implements FromArray, WithHeadings, ShouldAutoSize, WithTitle
{
    public function array():array
    {
        return Product::getDataProducts();
    }

    public function headings():array{
        return[
            'No',
            'Nama',
            'Stok',
            'Harga',
            'Kategori',
            'Merk',
        ];
    }

    public function title():string{
        return 'Daftar Product';
    }
}
