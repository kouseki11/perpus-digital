<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::get()->map(function ($book) {

            return [
                'Title' => $book->title,
                'Author' => $book->author,
                'Category' => $book->category->name == null ? '-' : $book->category->name,
                'Publisher' => $book->publisher,
                'Release Date' => $book->release_date
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Title',
            'Author',
            'Category',
            'Publisher',
            'Release Date'
        ];
    }
}
