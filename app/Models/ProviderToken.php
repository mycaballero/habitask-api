<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ProviderToken extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'token', 'model_id', 'model_type'];

    /**
     * @param $query
     * @param $model
     * @return void
     */
    public function scopeWhereModel($query, $model): void
    {
        if (!empty($model)) {
            $query->where('model_id', $model['id'])->where('model_type', $model['type']);
        }
    }

    /**
     * @param $query
     * @param $name
     * @return void
     */
    public function scopeWhereName($query, $name): void
    {
        if (isset($name)) {
            $query->where('name',$name);
        }
    }

    /**
     * @return MorphTo
     */
    public function model(): MorphTo
    {
        return $this->morphTo();
    }
}
