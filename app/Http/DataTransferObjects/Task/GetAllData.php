<?php

namespace App\Http\DataTransferObjects\Task;

use Spatie\LaravelData\Data;

class GetAllData extends Data
{
    /**
     * @param string|null $name
     * @param string|null $description
     * @param string|null $email
     * @param int|null $page
     * @param int|null $perPage
     * @param int|null $assigned_id
     * @param int|null $owner_id
     * @param string|null $start_date
     * @param string|null $end_date
     * @param string|null $sort
     * @param string|null $sortBy
     */
    public function __construct(
        public ?string $name,
        public ?string $description,
        public ?string $email,
        public ?int    $page,
        public ?int    $perPage,
        public ?int    $assigned_id,
        public ?int    $owner_id,
        public ?string $start_date,
        public ?string $end_date,
        public ?string $sort,
        public ?string $sortBy,
    )
    {
    }
}
