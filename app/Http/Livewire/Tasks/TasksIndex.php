<?php

namespace App\Http\Livewire\Tasks;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\TaskService;
use App\DTOs\TaskData;
use App\Models\Task;

class TasksIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public $editingTaskId = null;

    protected $listeners = ['taskSaved' => 'onTaskSaved'];

    protected $taskService;

    public function mount(TaskService $taskService)
    {
        $this->taskService = app(TaskService::class);
    }



    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetPage()
    {
        $this->page = 1;
    }

    public function render()
    {

        return view('livewire.tasks.index', [
            'tasks' => Task::where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })->paginate(10),
        ]);
    }

    public function edit($id)
    {
        $this->editingTaskId = $id;
        $this->emit('openTaskForm', $id);
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete($task);
        session()->flash('success', 'Tarefa removida.');
    }

    public function onTaskSaved()
    {
        $this->editingTaskId = null;
        session()->flash('success', 'Tarefa salva.');
    }
}
