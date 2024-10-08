<?php

declare(strict_types=1);

namespace App\Domain\Tag\Services;

use App\Domain\Tag\Entity\Tag;
use App\Domain\Tag\Repository\TagRepository;

class TagService
{
    public function __construct(
        private readonly TagRepository $tag_repository,
    )
    {
    }

    public function create(int $task_id, array $data): Tag
    {
        return $this->tag_repository->insert($task_id, $data);
    }

    public function remove(array $data): Tag
    {
        return $this->tag_repository->delete($data);
    }
}
