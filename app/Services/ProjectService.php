<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Project\TagException;
use App\Models\Project;
use App\Repositories\ProjectRepository;
use Illuminate\Support\Facades\Log;

class ProjectService
{
    public function __construct(
        private readonly ProjectRepository $projectRepository
    ) {
    }

    public function fetchAllProjects(int $userId, ?int $projectId): array
    {
        return $this->projectRepository->selectAll($userId, $projectId, true)->toArray();
    }

    /**
     * @throws TagException
     */
    public function create(array $taskData): array
    {
        try {
            return $this->projectRepository->insert($taskData);
        } catch (\Exception $e) {
            Log::error('ProjectService::create(): ' . $e->getMessage());
            throw new TagException('Failed to create the project. Try later.');
        }
    }

    /**
     * @throws TagException
     */
    public function remove(Project $project): ?bool
    {
        try {
            return $this->projectRepository->delete($project);
        } catch (\Exception $e) {
            Log::error('ProjectService::remove(): ' . $e->getMessage());
            throw new TagException('Failed to remove the project. Try later.');
        }
    }

    public function change(Project $project, array $data): array
    {
        try {
            return $this->projectRepository->update($project, $data);
        } catch (\Exception $e) {
            Log::error('ProjectService::change(): ' . $e->getMessage());
            throw new TagException('Failed to change the project. Try later.');
        }
    }
}
