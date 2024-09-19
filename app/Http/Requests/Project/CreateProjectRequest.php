<?php

declare(strict_types=1);

namespace App\Http\Requests\Project;

use App\DTO\ProjectDto;
use App\Http\Requests\BaseRequest;

class CreateProjectRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Project name is required.',
            'name.min' => 'Project name must be at least 3 characters.',
            'name.max' => 'Project name must be less than 255 characters.',
            'name.string' => 'Project name must be a string.',
        ];
    }

    public function getData(): ProjectDto
    {
        return new ProjectDto(
            $this->get('name'),
            auth()->id()
        );
    }
}
