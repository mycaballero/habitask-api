<?php

namespace App\Builders\Task;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class TaskBuilder extends Builder
{
    public function whereEmailOrName(?string $name): self
    {
        return $this->when(isset($name), function ($q) use ($name) {
                $q->where(function ($subquery) use ($name) {
                    $subquery->where('name', 'LIKE', '%' . $name . '%')
                        ->orWhereHas('assigned', function ($q2) use ($name) {
                            $q2->where('users.email', 'LIKE', '%' . $name . '%');
                        });
                });
        });
    }

    /**
     * @param int|null $id
     * @return self
     */
    public function whereOwnerId(?int $id): self
    {
        return $this->when(isset($id), function ($q) use ($id) {
           $q->where('owner_id', '=', $id);
        });
    }

    /**
     * @param string|null $startDate
     * @param string|null $endDate
     * @return $this
     */
    public function whereDates(?string $startDate, ?string $endDate): self
    {
        return $this->when(isset($startDate), function ($q) use ($startDate) {
            $q->where('start_date', '>=', Carbon::parse($startDate));
        })->when(isset($endDate), function ($q) use ($endDate) {
            $q->where('end_date', '<=', Carbon::parse($endDate));
        });
    }
}
