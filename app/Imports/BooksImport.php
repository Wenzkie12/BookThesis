<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BooksImport implements ToModel, WithHeadingRow
{
    public int $insertedCount = 0; 

    public function model(array $row)
    {
        if (Book::whereRaw('LOWER(title) = ?', [strtolower($row['title'])])->exists()) {
            return null;
        }

        $this->insertedCount++; 

        return new Book([
            'title'           => $row['title'],
            'author'          => $row['author'],
            'date_published'  => $row['date_published'],
            'quantity'        => $row['quantity'],
            'category_id'     => $row['category'],
        ]);
    }
}

