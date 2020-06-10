<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookRelationshipResource extends JsonResource
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
            'author' => [
                'links' => [
                    'self' => route('authors.relationship.author', ['book' => $this->id]),
                    'related' => route('books.author', ['book' => $this->id])
                ],
                'data' => new AuthorResourse($this->author)
            ]
        ];
    }

    public function with($request)
    {
        return [
            'links' => [
                'self' => route('books.index')
            ]
        ];
    }
}
