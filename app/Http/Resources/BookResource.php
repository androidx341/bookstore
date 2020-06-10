<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'books',
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'pages-count' => $this->pagesCount,
                'cover-image' => $this->coverImage,
                'author' => $this->authorId
            ],
            'links' => [
                'self' => route('books.show', ['book' => $this->id])
            ]
        ];
    }
}
