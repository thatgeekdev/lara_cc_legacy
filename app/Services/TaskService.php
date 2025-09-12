<?php
namespace App\Services;

use App\Models\Task;
use App\DTOs\TaskData;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Camada de serviço para manipulação de tarefas
 * - Criação, atualização, busca e paginação
 * - Mantém regras de negócio separadas do componente Livewire
 */
class TaskService
{
    /**
     * Retorna tarefas paginadas com filtros opcionais
     */
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

    /**
     * Cria uma nova tarefa usando DTO
     */
    public function create(TaskData $data): Task
    {
        return Task::create($data->toArray());
    }

    /**
     * Atualiza uma tarefa existente usando DTO
     */
    public function update(Task $task, TaskData $data): Task
    {
        $task->fill($data->toArray());
        $task->save();
        return $task;
    }

    /**
     * Encontra tarefa por ID
     */
    public function find(int $id): ?Task
    {
        return Task::find($id);
    }
}
