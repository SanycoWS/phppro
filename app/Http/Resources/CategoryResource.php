<?php

namespace App\Http\Resources;

use App\Repositories\Categories\Iterators\CategoryIterator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   schema="Category",
 *   description="The Category",
 *     @OA\Property(property="id", type="integer"),
 *     @OA\Property(property="name", type="string"),
 * )
 */
class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var CategoryIterator $resource */
        $resource = $this->resource;

        return [
            'id' => $resource->getId(),
            'name' => $resource->getName(),
        ];
    }
}
