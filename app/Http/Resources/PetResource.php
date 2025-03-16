<?php

namespace App\Http\Resources;

use App\Enums\PetStatusEnum;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Pet */
class PetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => PetStatusEnum::fromValue($this->status),
            'category' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'images' => ImageResource::collection($this->images),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
