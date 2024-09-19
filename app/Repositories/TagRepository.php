<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Tag;

class TagRepository
{
    public function insert(int $task_id, array $data): array
    {
        return Tag::create([
            'name' => $data['name'],
            'task_id' => $task_id,
        ])->toArray();
    }

    public function delete(array $data): bool
    {
        return Tag::find($data['id'])->delete();
    }
}
