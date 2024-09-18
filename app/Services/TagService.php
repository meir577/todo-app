<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\Project\TagException;
use App\Models\Project;
use App\Models\Task;
use App\Repositories\ProjectRepository;
use App\Repositories\TagRepository;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Log;

class TagService
{
    public function __construct(
        private readonly TagRepository $tagRepository,
    )
    {
    }

    public function create(int $taskId, array $data): array
    {
        return $this->tagRepository->insert($taskId, $data);
    }

    public function remove(array $data): void
    {
        $this->tagRepository->delete($data);
    }
}
