<h1>CREATE new Todo</h1>
<form wire:submit="save">
    <div class="form-group mb-3">
        <label for="todoTitle">Title:</label>
        <input type="text" wire:model="title" id="todoTitle">
        <div>
            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="todoPriority">Priority:</label>
        <select id="todoPriority" wire:model="priority">
            @for ($i = $PRIORITY[0]; $i <= $PRIORITY[1]; $i++)
                <option value="{{$i}}">{{$i}}</option>
            @endfor
        </select>
        <div>
            @error('priority') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="todocreatedAt">createdAt:</label>
        <input type="date" wire:model="createdAt" value="{{$createdAt}}" class="form-control @error('createdAt') is-invalid @enderror" id="todocreatedAt" placeholder="Enter createdAt">
        <div>
            @error('createdAt') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <button wire:click.prevent="resetFields()" class="btn btn-danger">Cancel</button>

</form>