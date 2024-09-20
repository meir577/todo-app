<?php

namespace App\Models;

use App\Models\Scopes\SelfTasksOnly;
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
