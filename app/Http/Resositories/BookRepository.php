<?php


namespace App\Http\Resositories;


use App\Book;
use Illuminate\Http\Request;

class BookRepository
{
    public static function withFilters(Request $request)
    {
        $books = Book::query();

        if ($request->has('authorId')) {
            $books->where('authorId', $request->authorId);
        }

        ////

        return $books;
    }
}
