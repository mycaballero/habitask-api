<?php

namespace App\Http\DataTransferObjects\Task;

use Spatie\LaravelData\Data;

class UpdateAllData extends Data
{
    /**
     * @param int|null $owner_id
     * @param int|null $assigned_id
     * @param string|null $name
     * @param string|null $description
     * @param string|null $start_date
     * @param string|null $end_date
     */
    public function __construct(
        public ?int    $owner_id,
        public ?int    $assigned_id,
        public ?string $name,
        public ?string $description,
        public ?string $start_date,
        public ?string $end_date,

    )
    {
    }

    /**
     * @return string[]
     */
    public static function rules(): array
    {
        return [
            'owner_id'    => 'nullable|integer',
            'assigned_id' => 'nullable|integer',
            'name'        => 'nullable|string|max:30',
            'description' => 'nullable|string|max:500',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date',
        ];
    }
}
