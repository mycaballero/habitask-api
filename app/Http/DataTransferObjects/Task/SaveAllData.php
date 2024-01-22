<?php

namespace App\Http\DataTransferObjects\Task;

use Spatie\LaravelData\Data;

class GetAllData extends Data
{
    public function __construct(
        public ?string $name,
        public ?string $description,
        public ?int    $page,
        public ?int    $perPage,
        public ?int    $asigned_id,
        public ?int    $owned_id,
        public ?string $sort,
        public ?string $sortBy,
    )
    {
    }
}
