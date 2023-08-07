<?php

namespace App\Http\Resources;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Book $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'name' => $resource->name,
            'year' => $resource->year,
            'category' => new CategoryModelResource($resource->category),
            'authors' => AuthorModelResource::collection($resource->authors),
            'createdAt' => $resource->created_at,
        ];
    }
}
