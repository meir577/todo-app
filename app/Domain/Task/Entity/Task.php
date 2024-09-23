<?php

declare(strict_types=1);

namespace App\Domain\Task\Entity;

use App\Domain\Project\Entity\Project;
use App\Domain\Tag\Entity\Tag;
use App\Domain\Task\Entity\Scopes\SelfTasksOnly;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'project_id', 'completed'
    ];

    protected $casts = [
        'completed' => 'boolean',
    ];

    protected $with = [
        'tags:id,name,task_id',
    ];

    protected static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class);
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new SelfTasksOnly);
    }
}
