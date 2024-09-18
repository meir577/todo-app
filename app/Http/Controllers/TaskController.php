<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use App\Usecases\Task\CreateTaskUsecase;
use App\Usecases\Task\DeleteTaskUsecase;
use App\Usecases\Task\GetTaskUsecase;
use App\Usecases\Task\Input\CreateTaskUsecaseInput;
use App\Usecases\Task\Input\DeleteTaskUsecaseInput;
use App\Usecases\Task\Input\GetTaskUsecaseInput;
use App\Usecases\Task\Input\UpdateTaskUsecaseInput;
use App\Usecases\Task\UpdateTaskUsecase;
use Illuminate\Http\JsonResponse;

class TaskController extends AbstractController
{
    public function index(GetTaskUsecase $getTasksUsecase): JsonResponse
    {
        $getTasksUsecaseInput = new GetTaskUsecaseInput([
            'userId' => request()->user()->getAuthIdentifier(),
            'projectId' => request()->get('project_id'),
            'name' => request()->get('name')
        ]);

        $getTasksUsecase->setInput($getTasksUsecaseInput);

        $getTasksUsecase->execute();

        $response = $getTasksUsecase->getOutput();

        return $this->json($response);
    }

    public function store(CreateTaskRequest $createTaskRequest, CreateTaskUsecase $createTaskUsecase): JsonResponse
    {
        $createTaskUsecaseInput = new CreateTaskUsecaseInput($createTaskRequest->getData());

        $createTaskUsecase->setInput($createTaskUsecaseInput);

        $createTaskUsecase->execute();

        $response = $createTaskUsecase->getOutput();

        return $this->json($response);
    }

    public function show(Task $task, GetTaskUsecase $getTaskUsecase): JsonResponse
    {
        $getTasksUsecaseInput = new GetTaskUsecaseInput($task->toArray());

        $getTaskUsecase->setInput($getTasksUsecaseInput);

        $getTaskUsecase->execute();

        $response = $getTaskUsecase->getOutput();

        return $this->json($response);
    }

    public function update(UpdateTaskRequest $updateTaskRequest, Task $task, UpdateTaskUsecase $updateTaskUsecase): JsonResponse
    {
        $updateTaskUsecaseInput = new UpdateTaskUsecaseInput($task, $updateTaskRequest->getData());

        $updateTaskUsecase->setInput($updateTaskUsecaseInput);

        $updateTaskUsecase->execute();

        $response = $updateTaskUsecase->getOutput();

        return $this->json($response);
    }

    public function destroy(Task $task, DeleteTaskUsecase $deleteTaskUsecase): JsonResponse
    {
        $deleteTaskUsecaseInput = new DeleteTaskUsecaseInput($task);

        $deleteTaskUsecase->setInput($deleteTaskUsecaseInput);

        $deleteTaskUsecase->execute();

        $response = $deleteTaskUsecase->getOutput();

        return $this->json($response);
    }
}
