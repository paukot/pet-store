<?php

namespace App\Http\Requests;

use App\Enums\PetStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetStoreUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:180'],
            'status' => ['required', 'integer', Rule::enum(PetStatusEnum::class)],
            'tags' => ['required', 'array'],
            'tags.*' => ['required', 'integer', 'exists:tags,id'],
            'photo' => ['sometimes', 'file', 'max:4096', 'mimes:jpg,jpeg,png'],
        ];
    }
}
