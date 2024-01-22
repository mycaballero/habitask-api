<?php

namespace App\Models;

use App\Builders\Task\TaskBuilder;
use App\Traits\GlobalScopesTraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory, GlobalScopesTraits;

    protected $fillable = [
        'owner_id',
        'assigned_id',
        'name',
        'description',
        'completed',
        'start_date',
        'end_date',
    ];

    /**
     * @param $query
     * @return TaskBuilder
     */
    public function newEloquentBuilder($query): TaskBuilder
    {
        return new TaskBuilder($query);
    }

    /**
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * @return BelongsTo
     */
    public function assigned(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }
}
