<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Project;
use App\Usecases\Project\CreateProjectUsecase;
use App\Usecases\Project\DeleteProjectUsecase;
use App\Usecases\Project\GetProjectUsecase;
use App\Usecases\Project\Input\CreateProjectUsecaseInput;
use App\Usecases\Project\Input\DeleteProjectUsecaseInput;
use App\Usecases\Project\Input\GetProjectUsecaseInput;
use App\Usecases\Project\Input\UpdateProjectUsecaseInput;
use App\Usecases\Project\UpdateProjectUsecase;
use Illuminate\Http\JsonResponse;

class ProjectController extends AbstractController
{
    public function index(GetProjectUsecase $getProjectUsecase): JsonResponse
    {
        $getProjectUsecaseInput = new GetProjectUsecaseInput(auth()->user()->getAuthIdentifier());

        $getProjectUsecase->setInput($getProjectUsecaseInput);

        $getProjectUsecase->execute();

        $response = $getProjectUsecase->getOutput();

        return $this->json($response);
    }

    public function store(CreateProjectRequest $createProjectRequest, CreateProjectUsecase $createProjectUsecase): JsonResponse
    {
        $createProjectUsecaseInput = new CreateProjectUsecaseInput($createProjectRequest->getData());

        $createProjectUsecase->setInput($createProjectUsecaseInput);

        $createProjectUsecase->execute();

        $response = $createProjectUsecase->getOutput();

        return $this->json($response);
    }

    public function show(Project $project, GetProjectUsecase $getProjectUsecase): JsonResponse
    {
        $getProjectUsecaseInput = new GetProjectUsecaseInput(auth()->user()->getAuthIdentifier(), $project);

        $getProjectUsecase->setInput($getProjectUsecaseInput);

        $getProjectUsecase->execute();

        $response = $getProjectUsecase->getOutput();

        return $this->json($response);
    }

    public function update(UpdateProjectRequest $updateProjectRequest, Project $project, UpdateProjectUsecase $updateProjectUsecase): JsonResponse
    {
        $updateProjectUsecaseInput = new UpdateProjectUsecaseInput($project, $updateProjectRequest->getData());

        $updateProjectUsecase->setInput($updateProjectUsecaseInput);

        $updateProjectUsecase->execute();

        $response = $updateProjectUsecase->getOutput();

        return $this->json($response);
    }

    public function destroy(Project $project, DeleteProjectUsecase $deleteProjectUsecase): JsonResponse
    {
        $deleteProjectUsecaseInput = new DeleteProjectUsecaseInput($project);

        $deleteProjectUsecase->setInput($deleteProjectUsecaseInput);

        $deleteProjectUsecase->execute();

        $response = $deleteProjectUsecase->getOutput();

        return $this->json($response);
    }
}
