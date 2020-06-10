<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'annotation',
        'pagesCount',
        'authorId',
        'coverImage',
        'createBy'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
