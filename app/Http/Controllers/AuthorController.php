<?php

namespace App\Http\Controllers;


use App\Author;
use App\Http\Resources\AuthorResourse;
use App\Http\Resources\AuthorsResourse;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new AuthorsResourse(Author::with([])->paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return AuthorResourse
     */
    public function show(Author $author)
    {
        AuthorResourse::withoutWrapping();
        return new AuthorResourse($author);
    }
}
