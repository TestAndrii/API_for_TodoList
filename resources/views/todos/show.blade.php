<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Todos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-right">
                            <a class="btn btn-primary" href="{{ route('todos.index') }}"> Back</a>
                        </div>
                    </div>
                </div>

                <table class="table bg-white border">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Title</th>
                        <th>CreatedAt</th>
                        <th>CompletedAt</th>
                        <th>Subtask</th>
                        <th>user_id</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                @if (isset($todo))
                    <tbody>
                    <tr>
                        <td>{{ $todo->id }}</td>
                        <td>{{ $statuses[$todo->status] }}</td>
                        <td>{{ $todo->priority }}</td>
                        <td>{{ $todo->title }}</td>
                        <td>{{ $todo->createdAt }}</td>
                        <td>{{ $todo->completedAt }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('todos.show',$todo->subtask) }}">{{ $todo->subtask }}</a></br>
                        </td>
                        <td>{{ $todo->user_id }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('todos.edit',$todo->id) }}">Edit</a>
                            <form action="{{ route('todos.destroy',$todo->id) }}" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
                @endif
                </table>


            </div>
        </div>
    </div>
</x-app-layout>