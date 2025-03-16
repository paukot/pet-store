<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetIndexRequest;
use App\Http\Requests\PetStoreUpdateRequest;
use App\Http\Resources\PetCollection;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use App\Services\PetService;

class PetController extends Controller
{
    public function __construct(
        private PetService $petService
    ) {
    }

    public function index(PetIndexRequest $request)
    {
        return response()->json(
            new PetCollection($this->petService->index($request))
        );
    }

    public function store(PetStoreUpdateRequest $request)
    {
        return response()->json(
            new PetResource($this->petService->store($request))
        );
    }

    public function show(Pet $pet)
    {
        return response()->json(new PetResource($pet));
    }

    public function update(PetStoreUpdateRequest $request, Pet $pet)
    {
        return response()->json(
            new PetResource($this->petService->update($request, $pet))
        );
    }

    public function destroy(Pet $pet)
    {
        if ($this->petService->delete($pet)) {
            return response()->json(status: 204);
        }

        return response()->json(status: 400);
    }
}
