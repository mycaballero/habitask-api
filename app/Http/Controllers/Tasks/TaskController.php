<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\DataTransferObjects\Task\GetAllData;
use App\Http\DataTransferObjects\Task\SaveAllData;
use App\Http\DataTransferObjects\Task\UpdateAllData;
use App\Http\Resources\Task\TaskResource;
use App\Http\Services\Task\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TaskController extends Controller
{

    public function __construct(
        protected TaskService $taskService
    )
    {
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return TaskResource::collection($this->taskService->getAll(GetAllData::from($request)));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json($this->taskService->create(SaveAllData::from($request)));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json($this->taskService->update($id, UpdateAllData::from($request)));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function updateCompleted($id): JsonResponse
    {
        return response()->json($this->taskService->updateCompleted($id));
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $this->taskService->delete($id);
        return response()->json([], 204);
    }
}
