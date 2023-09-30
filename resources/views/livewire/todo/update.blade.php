<h1>UPDATE new Todo</h1>
<form wire:submit="update">
    <input type="hidden" wire:model="user_id">

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
        <label for="todoTitle">Title:</label>
        <input type="text" wire:model="title" id="todoTitle">
        <div>
            @error('title') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>


    <div class="form-group mb-3">
        <label for="todoStatus">Status:</label>
        <select id="todoStatus" wire:model.live="status">
            @foreach($STATUS as $key=>$s)
            <option value="{{$key}}"
                    @if($key == $status)
                        select
                    @endif
            >{{$s}}</option>
            @endforeach
        </select>
        @error('status') <span class="text-danger">{{ $message }}</span>@enderror
    </div>

    <div class="form-group mb-3">
        <label for="todocreatedAt">createdAt:</label>
        <input type="date" wire:model="createdAt" value="{{$createdAt}}" id="todocreatedAt">
        <div>
            @error('createdAt') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="todoCompletedAt">completedAt:</label>
        <input type="date" wire:model="completedAt" id="todoCompletedAt">
        <div>
            @error('completedAt') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="form-group mb-3">
        <label for="todoSubtask">subtask:</label>
        <select id="todoSubtask" wire:model="subtask">
            <option value="null">not</option>
            @foreach($tasks as $t)
                <option value="{{$t->id}}"
                    {{ ($t->id == $subtask) ? "select" : "" }}
                >{{$t->id}}</option>
            @endforeach
        </select>
        <div>
            @error('subtask') <span class="text-danger">{{ $message }}</span>@enderror
        </div>
    </div>

    <div class="d-grid gap-2">
        <button wire:click.prevent="update()" class="btn btn-success btn-block">Save</button>
        <button wire:click.prevent="resetFields()" class="btn btn-danger">Cancel</button>
    </div>
</form>