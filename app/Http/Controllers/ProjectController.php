<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Project\Entity\Project;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
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
    public function index(GetProjectUsecase $get_project_usecase): JsonResponse
    {
        $get_project_usecase_input = new GetProjectUsecaseInput(auth()->user()->getAuthIdentifier());

        $get_project_usecase->setInput($get_project_usecase_input);

        $get_project_usecase->execute();

        $response = $get_project_usecase->getOutput();

        return $this->json($response);
    }

    public function store(CreateProjectRequest $create_project_request, CreateProjectUsecase $create_project_usecase): JsonResponse
    {
        $create_project_usecase_input = new CreateProjectUsecaseInput($create_project_request->getData());

        $create_project_usecase->setInput($create_project_usecase_input);

        $create_project_usecase->execute();

        $response = $create_project_usecase->getOutput();

        return $this->json($response);
    }

    public function show(Project $project, GetProjectUsecase $get_project_usecase): JsonResponse
    {
        $get_project_usecase_input = new GetProjectUsecaseInput(auth()->user()->getAuthIdentifier(), $project);

        $get_project_usecase->setInput($get_project_usecase_input);

        $get_project_usecase->execute();

        $response = $get_project_usecase->getOutput();

        return $this->json($response);
    }

    public function update(UpdateProjectRequest $update_project_request, Project $project, UpdateProjectUsecase $update_project_usecase): JsonResponse
    {
        $update_project_usecase_input = new UpdateProjectUsecaseInput($project, $update_project_request->getData());

        $update_project_usecase->setInput($update_project_usecase_input);

        $update_project_usecase->execute();

        $response = $update_project_usecase->getOutput();

        return $this->json($response);
    }

    public function destroy(Project $project, DeleteProjectUsecase $delete_project_usecase): JsonResponse
    {
        $delete_project_usecase_input = new DeleteProjectUsecaseInput($project);

        $delete_project_usecase->setInput($delete_project_usecase_input);

        $delete_project_usecase->execute();

        $response = $delete_project_usecase->getOutput();

        return $this->json($response);
    }
}
