<?php

namespace App\Http\Resources;

use App\Repositories\Users\Itterators\UserIterator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var UserIterator $user */
        $user = $this->resource;

        return [
            'id' => $user->getId(),
            'email' => $user->getEmail(),
        ];
    }
}
