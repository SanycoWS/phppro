<?php

namespace App\Http\Resources;

use App\Repositories\Books\Iterators\BookIterator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   schema="Book",
 *   description="The Book",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="year", type="integer"),
 *     @OA\Property(property="createdAt", type="string", example="2023-09-18T16:51:40.000000Z"),
 *     @OA\Property(property="category", ref="#/components/schemas/Category"),
 * )
 */
class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var BookIterator $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->getId(),
            'name' => $resource->getName(),
            'year' => $resource->getYear(),
            'category' => new CategoryResource($resource->getCategory()),
            //  'authors' => AuthorResource::collection($resource->getAuthors()->getIterator()->getArrayCopy()),
            'createdAt' => $resource->getCreatedAt(),
        ];
    }
}
