<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;

class UpdateTaskRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:255',
            'project_id' => 'required|integer|exists:projects,id',
            'completed' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Task name is required.',
            'name.min' => 'Task name must be at least 3 characters.',
            'name.max' => 'Task name must be less than 255 characters.',
            'project_id.required' => 'Project is required.',
            'project_id.integer' => 'Project must be an integer.',
            'project_id.exists' => 'Project does not exist.',
            'completed.boolean' => 'Completed field must be boolean.',
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->get('name'),
            'completed' => $this->get('completed'),
            'project_id' => $this->get('project_id'),
        ];
    }
}
