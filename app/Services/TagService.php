<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\TagRepository;

class TagService
{
    public function __construct(
        private readonly TagRepository $tag_repository,
    )
    {
    }

    public function create(int $taskId, array $data): array
    {
        return $this->tag_repository->insert($taskId, $data);
    }

    public function remove(array $data): void
    {
        $this->tag_repository->delete($data);
    }
}
