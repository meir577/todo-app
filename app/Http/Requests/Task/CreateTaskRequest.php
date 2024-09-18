<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;

class CreateTaskRequest extends BaseRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Task name is required',
            'name.min' => 'Task name must be at least 3 characters',
            'name.max' => 'Task name must be less than 255 characters',
            'project_id.required' => 'Project id is required',
            'project_id.integer' => 'Project id must be an integer',
            'project_id.exists' => 'Project id is invalid',
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->input('name'),
            'completed' => false,
            'project_id' => $this->input('project_id'),
        ];
    }
}
