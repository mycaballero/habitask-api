<?php

namespace App\Http\Services\Task;

use App\Http\DataTransferObjects\Task\GetAllData;
use App\Http\DataTransferObjects\Task\SaveAllData;
use App\Http\DataTransferObjects\Task\UpdateAllData;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskService
{
    /**
     * @param GetAllData $data
     * @return LengthAwarePaginator|Collection
     */
    public function getAll(GetAllData $data): LengthAwarePaginator|Collection;

    /**
     * @param SaveAllData $data
     * @return Task
     */
    public function create(SaveAllData $data): Task;

    /**
     * @param $id
     * @param UpdateAllData $data
     * @return Task|bool
     */
    public function update($id, UpdateAllData $data): Task|bool;

    /**
     * @param int $id
     * @return Task
     */
    public function updateCompleted(int $id): Task;

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
