<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;

class ImageService
{
    public function store(UploadedFile $file, int $petId): ?Image
    {
        try {
            $path = $file->store('pets/' . $petId, 'public');

            return Image::create([
                'pet_id' => $petId,
                'path' => $path,
                'url' => asset($path),
            ]);
        } catch (\Exception $exception) {
            \Log::error($exception->getFile() . '@' . $exception->getLine() . ': ' . $exception->getMessage());
        }
    }

    public function delete(Image $image): ?bool
    {
        \Storage::delete($image->path);
        return $image->delete();
    }
}