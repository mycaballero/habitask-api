<?php

namespace App\Traits;

trait GlobalScopesTraits
{
    /**
     * @param $query
     * @param $sortBy
     * @param $sort
     * @return void
     */
    public function scopeOrderByForColumn($query, $sortBy, $sort): void
    {
        if ((isset($sortBy) && isset($sort))) {
            $query->orderBy($sortBy, $sort);
        } else {
            $query->orderBy('name');
        }
    }
}

