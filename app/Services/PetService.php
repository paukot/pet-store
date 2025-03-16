<?php

namespace App\Services;

use App\Http\Requests\PetIndexRequest;
use App\Http\Requests\PetStoreUpdateRequest;
use App\Models\Pet;
use Illuminate\Pagination\LengthAwarePaginator;

class PetService
{
    public function __construct(
        private ImageService $imageService
    ) {
    }

    public function index(PetIndexRequest $request): LengthAwarePaginator
    {
        $pets = Pet::with(['category', 'tags', 'images']);

        return $pets->paginate($request->get('limit', 50));
    }

    public function store(PetStoreUpdateRequest $request): Pet
    {
        $photo = $request->file('photo');
        $tags = $request->get('tags', null);

        $pet = Pet::create([
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'status' => $request->get('status'),
        ]);

        $pet->tags()->attach($tags);

        if (!empty($photo)) {
            $this->imageService->store($photo, $pet->id);
        }

        return $pet;
    }

    public function update(PetStoreUpdateRequest $request, Pet $pet): Pet
    {
        $photo = $request->file('photo');
        $tags = $request->get('tags', null);

        $pet->fill([
            'category_id' => $request->get('category_id'),
            'name' => $request->get('name'),
            'status' => $request->get('status'),
        ])->save();

        $pet->tags()->sync($tags);

        if (!empty($photo)) {
            $this->imageService->store($photo, $pet->id);
        }

        return $pet;
    }

    public function delete(Pet $pet): ?bool
    {
        foreach ($pet->images as $image) {
            $this->imageService->delete($image);
        }

        return $pet->delete();
    }
}