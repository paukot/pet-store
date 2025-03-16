<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Image */
class ImageResource extends JsonResource
{
    public function toArray(Request $request): string
    {
        return $this->url;
    }
}
