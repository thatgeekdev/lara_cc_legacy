<div>
    
    <div class="d-flex justify-content-between mb-3">
        <div>
            <input wire:model.debounce.300ms="search" class="form-control" placeholder="Buscar...">
        </div>
        <div>
            <button class="btn btn-primary" wire:click.prevent="$emit('openTaskForm')">Nova Tarefa</button>
        </div>
    </div>

    @if(session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ Str::limit($task->description, 50) }}</td>
                    <td>{{ format_status($task->status) }}</td>
                    <td>
                        <button class="btn btn-sm btn-info" wire:click.prevent="edit({{ $task->id }})">Editar</button>
                        <button class="btn btn-sm btn-danger" wire:click="delete({{ $task->id }})">Apagar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tasks->links() }}

    @livewire('tasks.tasks-form')
</div>