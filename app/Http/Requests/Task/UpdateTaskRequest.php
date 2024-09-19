<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\DTO\TaskDto;
use App\Http\Requests\BaseRequest;
use App\Rules\BelongsToUserProjects;

class UpdateTaskRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'min:3', 'max:255'],
            'project_id' => ['nullable', 'integer', new BelongsToUserProjects],
            'completed' => ['nullable', 'boolean']
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'Task name must be at least 3 characters.',
            'name.max' => 'Task name must be less than 255 characters.',
            'project_id.integer' => 'Project id must be an integer.',
            'project_id.exists' => 'Project does not exist.',
            'completed.boolean' => 'Completed field must be boolean.',
        ];
    }

    public function getData(): TaskDto
    {
        return new TaskDto(
            $this->get('name'),
            $this->get('completed'),
            $this->get('project_id')
        );
    }
}
