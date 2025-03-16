<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Pet */
class PetCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => PetResource::collection($this->resource),
            'per_page' => $this->perPage(),
            'current_page' => $this->currentPage(),
            'total' => $this->total(),
            'last_page' => $this->lastPage(),
            'next_page_url' => $this->nextPageUrl(),
            'prev_page_url' => $this->previousPageUrl(),
        ];
    }
}
