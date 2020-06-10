<?php

namespace App\Http\Controllers;

use App\Book;
use App\Http\Requests\BookCreateRequest;
use App\Http\Resositories\BookRepository;
use App\Http\Resources\BookResource;
use App\Http\Resources\BooksResource;
use App\Http\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $books = BookRepository::withFilters($request);

        return new BooksResource($books->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        if ($book = BookService::createBook($request)) {
            return $book;
        }

        return response()->json(['error' => 'Server error'], 500);
    }

    /**
     * Display the book resource.
     *
     * @param Book $book
     * @return BookResource
     */
    public function show(Book $book)
    {
        BookResource::withoutWrapping();
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookCreateRequest $request, $id)
    {
        $book = Book::findOrFail($id);

        if (Gate::denies('update-book', $book)) {
            return response()->json(['error' => 'Yoy can not edit this book'], 403);
        }

        if ($book = BookService::updateBook($request, $book)) {
            return $book;
        }

        return response()->json(['error' => 'Server error'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if (Gate::denies('update-book', $book)) {
            return response()->json(['error' => 'Yoy can not remove this book'], 403);
        }

        if (BookService::removeBook($book)) {
            return response()->json(['error' => 'Book removed successful'], 200);
        }

        return response()->json(['error' => 'Server error'], 500);
    }
}
