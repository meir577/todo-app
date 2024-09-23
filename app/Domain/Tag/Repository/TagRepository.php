<?php

declare(strict_types=1);

namespace App\Domain\Tag\Repository;

use App\Domain\Tag\Entity\Tag;

class TagRepository
{
    public function insert(int $task_id, array $data): Tag
    {
        return Tag::create([
            'name' => $data['name'],
            'task_id' => $task_id,
        ]);
    }

    public function delete(array $data): Tag
    {
        $tag = Tag::find($data['id']);
        $tag->delete();

        return $tag;
    }
}
