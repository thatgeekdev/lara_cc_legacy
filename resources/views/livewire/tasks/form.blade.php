<div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label>Título</label>
            <input wire:model="title" class="form-control">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <textarea wire:model="description" class="form-control"></textarea>
            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label>Status</label>
            <select wire:model="status" class="form-control">
                <option value="pending">Pendente</option>
                <option value="done">Concluída</option>
            </select>
            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>