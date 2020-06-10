<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResourse extends JsonResource
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
            'type' => 'authors',
            'id' => (string) $this->id,
            'attributes' => [
                'first-name' => $this->firstName,
                'second-name' => $this->secondName,
            ],
        ];
    }
}
