<?php

declare(strict_types=1);

namespace App\Domain\Tag\Entity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'task_id'
    ];
}
