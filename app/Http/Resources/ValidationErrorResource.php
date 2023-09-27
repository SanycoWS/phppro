<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *   schema="Errors",
 *   description="The Category",
 *     @OA\Property(property="errors", type="object", description="each key describe error message"),
 *     @OA\Property(property="message", type="string"),
 * )
 */
class ValidationErrorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \Exception $exception */
        $exception = $this->resource;

        return [
            'message' => $exception->getMessage(),
            'errors' => $exception->getCode(),
        ];
    }
}
