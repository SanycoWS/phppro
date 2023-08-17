<?php

namespace App\Http\Resources;

use App\Repositories\Authors\Iterators\AuthorWithoutBooksIterator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var AuthorWithoutBooksIterator $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->getId(),
            'name' => $resource->getName(),
        ];
    }
}
