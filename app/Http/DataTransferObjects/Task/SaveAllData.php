<?php

namespace App\Http\DataTransferObjects\Task;

use Spatie\LaravelData\Data;

class SaveAllData extends Data
{
    /**
     * @param int $assigned_id
     * @param string $name
     * @param string|null $description
     * @param string $start_date
     * @param string $end_date
     */
    public function __construct(
        public int    $assigned_id,
        public string $name,
        public ?string $description,
        public string $start_date,
        public string $end_date,

    )
    {
    }

    /**
     * @return string[]
     */
    public static function rules(): array
    {
        return [
            'assigned_id' => 'nullable|integer',
            'name'        => 'string|max:30',
            'description' => 'string|max:500',
            'start_date'  => 'date',
            'end_date'    => 'date',
        ];
    }
}
