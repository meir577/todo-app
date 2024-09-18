<?php

declare(strict_types=1);

namespace App\Http\Requests\Tag;

use App\Http\Requests\BaseRequest;

class AddTagRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:30'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tag name is required.',
            'name.string' => 'Tag name must be a string.',
            'name.min' => 'Tag name must be at least 3 characters.',
            'name.max' => 'Tag name must be less than 30 characters.',
            'name.unique' => 'Tag name must be unique.',
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->get('name'),
        ];
    }
}
