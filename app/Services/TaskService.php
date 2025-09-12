<?php

namespace App\Services;

use App\Models\Task;
use App\DTOs\TaskData;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskService
{
    public function paginate(int $perPage = 10, array $filters = []): LengthAwarePaginator
    {
        $query = Task::query();

        if (!empty($filters['q'])) {
            $q = $filters['q'];
            $query->where('title', 'like', "%{$q}%")
                  ->orWhere('description', 'like', "%{$q}%");
        }

        return $query->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function create(TaskData $data): Task
    {
        return Task::create($data->toArray());
    }

    public function update(Task $task, TaskData $data): Task
    {
        $task->fill($data->toArray());
        $task->save();
        return $task;
    }

    public function find(int $id): ?Task
    {
        return Task::find($id);
    }
}