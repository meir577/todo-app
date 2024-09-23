<?php

declare(strict_types=1);

namespace App\Domain\Project\Entity;

use App\Domain\Project\Entity\Scopes\SelfProjectsOnly;
use App\Domain\Task\Entity\Task;
use App\Domain\User\Entity\User;
use Database\Factories\ProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id'
    ];

    protected static function newFactory(): ProjectFactory
    {
        return ProjectFactory::new();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class, 'project_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected static function booted(): void
    {
        static::addGlobalScope(new SelfProjectsOnly);
    }
}
