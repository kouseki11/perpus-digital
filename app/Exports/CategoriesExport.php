<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoriesExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::get()->map(function ($category) {

            return [
                'Name' => $category->name,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
        ];
    }
}
