<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BooksResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => BookResource::collection($this->collection),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return array|array[]
     */
    public function with($request)
    {
        return [
            'links' => [
                'self' => route('books.index')
            ]
        ];
    }
}
