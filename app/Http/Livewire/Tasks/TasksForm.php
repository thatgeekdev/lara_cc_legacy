<?php

namespace App\Http\Livewire\Tasks;

use Livewire\Component;
use App\DTOs\TaskData;
use App\Services\TaskService;
use App\Models\Task;

class TasksForm extends Component
{
    public $taskId = null;
    public $title;
    public $description;
    public $status = 'pending';

    protected $listeners = ['openTaskForm' => 'open'];

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:pending,done',
    ];

    protected $taskService;

    public function mount()
    {
        $this->taskService = new TaskService();
    }


    public function open($id = null)
    {
        $this->resetValidation();

        $this->title = null;
        $this->description = null;
        $this->status = 'pending';
        $this->taskId = null;

        if ($id) {
            $task = Task::findOrFail($id);
            $this->taskId = $task->id;
            $this->title = $task->title;
            $this->description = $task->description;
            $this->status = $task->status;
        }

    }

    public function save()
    {
        $dto = new TaskData([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
        ]);

        $taskService = app(\App\Services\TaskService::class);

        if ($this->taskId) {
            $task = Task::findOrFail($this->taskId);
            $taskService->update($task, $dto);
        } else {
            $taskService->create($dto);
        }

        $this->emit('taskSaved');
        session()->flash('success', 'Tarefa salva.');
    }
    
    public function render()
    {
        return view('livewire.tasks.form');
    }
}