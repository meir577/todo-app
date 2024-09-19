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
    public function index(GetTaskUsecase $get_task_usecase): JsonResponse
    {
        $get_task_usecase_input = new GetTaskUsecaseInput([
            'user_id' => request()->user()->getAuthIdentifier(),
            'project_id' => request()->get('project_id'),
            'name' => request()->get('name')
        ]);

        $get_task_usecase->setInput($get_task_usecase_input);

        $get_task_usecase->execute();

        $response = $get_task_usecase->getOutput();

        return $this->json($response);
    }

    public function store(CreateTaskRequest $create_task_request, CreateTaskUsecase $create_task_usecase): JsonResponse
    {
        $create_task_usecase_input = new CreateTaskUsecaseInput($create_task_request->getData());

        $create_task_usecase->setInput($create_task_usecase_input);

        $create_task_usecase->execute();

        $response = $create_task_usecase->getOutput();

        return $this->json($response);
    }

    public function show(Task $task, GetTaskUsecase $get_task_usecase): JsonResponse
    {
        $get_task_usecase_input = new GetTaskUsecaseInput($task->toArray());

        $get_task_usecase->setInput($get_task_usecase_input);

        $get_task_usecase->execute();

        $response = $get_task_usecase->getOutput();

        return $this->json($response);
    }

    public function update(UpdateTaskRequest $update_task_request, Task $task, UpdateTaskUsecase $update_task_usecase): JsonResponse
    {
        $update_task_usecase_input = new UpdateTaskUsecaseInput($task, $update_task_request->getData());

        $update_task_usecase->setInput($update_task_usecase_input);

        $update_task_usecase->execute();

        $response = $update_task_usecase->getOutput();

        return $this->json($response);
    }

    public function destroy(Task $task, DeleteTaskUsecase $delete_task_usecase): JsonResponse
    {
        $delete_task_usecase_input = new DeleteTaskUsecaseInput($task);

        $delete_task_usecase->setInput($delete_task_usecase_input);

        $delete_task_usecase->execute();

        $response = $delete_task_usecase->getOutput();

        return $this->json($response);
    }
}
