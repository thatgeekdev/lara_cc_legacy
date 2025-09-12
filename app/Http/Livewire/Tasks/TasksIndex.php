<?php
namespace App\Http\Livewire\Tasks;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\TaskService;
use App\Models\Task;

/**
 * TasksIndex é responsável por exibir a lista de tarefas
 * com pesquisa, paginação e ações de edição/exclusão.
 *
 * Boas práticas:
 * - Separação de responsabilidades: busca e persistência de dados via TaskService.
 * - Eventos do Livewire para comunicação com componentes filhos (TasksForm).
 */
class TasksIndex extends Component
{
    use WithPagination; // Fornece funcionalidades de paginação

    // Propriedades vinculadas à view
    public $search = ''; // Termo de busca
    public $perPage = 10; // Número de itens por página
    public $editingTaskId = null; // ID da tarefa em edição

    protected $listeners = ['taskSaved' => 'onTaskSaved']; // Escuta evento do componente filho

    protected $taskService;

    /**
     * Método executado ao montar o componente.
     * Recebe TaskService via DI (Dependency Injection)
     */
    public function mount(TaskService $taskService)
    {
        $this->taskService = app(TaskService::class);
    }

    /**
     * Resetar paginação ao atualizar a busca
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Reinicia a página para 1
     */
    public function resetPage()
    {
        $this->page = 1;
    }

    /**
     * Renderiza a view de tarefas
     */
    public function render()
    {
        return view('livewire.tasks.index', [
            // Busca e paginação utilizando filtro de pesquisa
            'tasks' => Task::where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })->paginate($this->perPage),
        ]);
    }

    /**
     * Abre o formulário de edição para uma tarefa específica
     */
    public function edit($id)
    {
        $this->editingTaskId = $id;
        $this->emit('openTaskForm', $id); // Emite evento para o formulário
    }

    /**
     * Exclui uma tarefa pelo ID
     */
    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        session()->flash('success', 'Tarefa removida.');
    }

    /**
     * Evento disparado quando uma tarefa é salva (criação ou edição)
     */
    public function onTaskSaved()
    {
        $this->editingTaskId = null;
        session()->flash('success', 'Tarefa salva.');
    }
}
