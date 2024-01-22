<?php

namespace App\Http\Services\Task\Impl;

use App\Http\DataTransferObjects\Task\GetAllData;
use App\Http\DataTransferObjects\Task\SaveAllData;
use App\Http\DataTransferObjects\Task\UpdateAllData;
use App\Http\Services\Task\TaskService;
use App\Mail\AdviceMailable;
use App\Models\Task;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskServiceImpl implements TaskService
{
    /**
     * @param GetAllData $data
     * @return LengthAwarePaginator|Collection
     */
    public function getAll(GetAllData $data): LengthAwarePaginator|Collection
    {
        $sortBy = $data->sortBy;
        $query = Task::query()->with(['owner','assigned'])
            ->whereOwnerId($data->owner_id?? null)
            ->whereEmailOrName($data->name?? null)
            ->whereDates($data->start_date, $data->end_date)
            ->OrderByForColumn($sortBy?: 'name', $data->sort?: 'asc');
        return $query->paginate($data->perPage ?? 10);
    }

    /**
     * @param SaveAllData $data
     * @return Task
     */
    public function create(SaveAllData $data): Task
    {
        $user = Auth::user();
        $payload = [
            'owner_id' => $user->id,
            'assigned_id' => $data->assigned_id,
            'name' => $data->name,
            'description' => $data->description,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
        ];
        return Task::create($payload);
    }

    /**
     * @param $id
     * @param UpdateAllData $data
     * @return Task|bool
     */
    public function update($id, UpdateAllData $data): Task|bool
    {
        $user = Auth::user();
        $task = Task::find($id);
        if ($user->id === $data->owner_id) {
            $payload = [
                'assigned_id' => $data->assigned_id,
                'name' => $data->name,
                'description' => $data->description,
                'start_date' => $data->start_date,
                'end_date' => $data->end_date,
            ];
            return $task->update($payload);
        }
        return false;
    }

    /**
     * @param int $id
     * @return Task
     */
    public function updateCompleted(int $id): Task
    {
        $user = Auth::user();
        $task = Task::findOrFail($id);
        if ($user->id === $task->owner_id) {
            $task->update([
                'completed' => filter_var(true, FILTER_VALIDATE_BOOLEAN)
            ]);
            $this->sendEmail($task);
        }
        return $task;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $user = Auth::user();
        $task = Task::find($id);
        if ($user->id === $task->owner_id) {
            $task->delete();
        }
    }

    /**
     * @param $task
     * @return void
     */
    private function sendEmail($task): void
    {
        $user = User::find($task->assigned_id);
        Mail::to($user->email)->send(new AdviceMailable($user));
    }
}
