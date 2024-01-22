<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'completed' => $this->completed,
            'assigned' => [
                'id' => $this->assigned->id,
                'name' => $this->assigned->name,
                'email' => $this->assigned->email,
            ],
            'owner' => [
                'id' => $this->owner->id,
                'name' => $this->owner->name
            ],
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }
}
