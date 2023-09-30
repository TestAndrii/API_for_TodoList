<div>
     <div class="col-md-8 mb-2">
               <div class="card items-center">
                    @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                         {{ session()->get('success') }}
                    </div>
                    @endif

                    @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                         {{ session()->get('error') }}
                    </div>
                    @endif

                    @if($updateTodo)
                    @include('livewire.todo.update')
                    @elseif ($createTodo)
                    @include('livewire.todo.create')
                    @endif
               </div>
     </div>

     <div class="col-md-8 items-center space-y-4">
          <div class="table-responsive">
               <table class="table-bordered text-center">
                    <thead>
                    <tr>
                         <th>Id</th>
                         <th>status (0,1)</th>
                         <th>Priority(1-5)</th>
                         <th>Title</th>
                         <th>CreatedAt</th>
                         <th>CompletedAt</th>
                         <th>Subtask</th>
                         <th colspan="2">Action</th>
                    </tr>
                    <tr>
                         <th>Filter</th>
                         <th>
                              <input wire:model.live="filter_status" type="text">
                         </th>
                         <th>
                              <input wire:model.live="filter_priority" type="text">
                         </th>
                         <th>
                              <input wire:model.live="title_search" type="text">
                         </th>
                         <th colspan="4"></th>
                         <th>
                              <x-button wire:click="create" class="btn btn-info btn-sm">Create</x-button>
                         </th>
                    </tr>
                    <tr>
                         <th>Sort:</th>
                         <th></th>
                         <th>
                              <x-button wire:click="Sorting('priority')" class="btn btn-info btn-sm">up/down</x-button>
                         </th>
                         <th></th>
                         <th>
                              <x-button wire:click="Sorting('created')" class="btn btn-info btn-sm">up/down</x-button>
                         </th>
                         <th>
                              <x-button wire:click="Sorting('completed')" class="btn btn-info btn-sm">up/down</x-button>
                         </th>
                         <th></th>
                         <th></th>
                         <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($todos) > 0)
                    @foreach ($todos as $todo)
                    <tr>
                         <td>{{$todo->id}}</td>
                         <td class={{ $todo->status == 1 ? "bg-green-600" : "bg-red-600" }}>
                              {{$STATUS[$todo->status]}}
                         </td>
                         <td>{{$todo->priority}}</td>
                         <td>{{$todo->title}}</td>
                         <td>{{$todo->createdAt}}</td>
                         <td>{{$todo->completedAt}}</td>
                         <td>{{$todo->subtask}}</td>
                         <td>
                              <x-button wire:click="edit({{$todo->id}})" class="btn btn-primary btn-sm">Edit</x-button>
                         </td>
                         <td>
                              <x-button wire:click="deleteTodo({{$todo->id}})" class="btn btn-danger btn-sm">Delete</x-button>
                         </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                         <td colspan="3" align="center">
                              No Todos Found.
                         </td>
                    </tr>
                    @endif
                    </tbody>
               </table>
          </div>
     </div>
</div>