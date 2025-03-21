<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'limit' => ['nullable', 'integer', 'min:1', 'max:1000'],
        ];
    }
}
