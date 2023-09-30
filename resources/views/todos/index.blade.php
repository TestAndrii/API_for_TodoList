<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Index Todos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg items-center">
                <div class="row">
                    <div class="w-2/12 bg-white">
                        <div class="pull-right">
                            <a href="{{ route('todos.create') }}">
                                <button class="btn btn-info">
                                    Create New Todo
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <table class="table border-separate">
                    <thead>
                    <tr class="bg-green-100">
                        <th>Id</th>
                        <th>status</th>
                        <th>Priority</th>
                        <th>Title</th>
                        <th>CreatedAt</th>
                        <th>CompletedAt</th>
                        <th>Subtask</th>
                        <th>user_id</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($todos as $todo)
                    <tr class="odd:bg-white even:bg-slate-50">
                        <td>{{ $todo->id }}</td>
                        <td>{{ $statuses[$todo->status] }}</td>
                        <td>{{ $todo->priority }}</td>
                        <td>{{ $todo->title }}</td>
                        <td>{{ $todo->createdAt }}</td>
                        <td>{{ $todo->completedAt }}</td>
                        <td>
                            @if ( $todo->subtask > 0)
                            <a class="btn btn-info" href="{{ route('todos.show',$todo->subtask) }}">{{ $todo->subtask }}</a>
                            @else
                             -
                            @endif
                        </td>
                        <td>{{ $todo->user_id }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('todos.show',$todo->id) }}">
                                <button class="bg-yellow-800 hover:bg-yellow-800">
                                    Show
                                </button>
                            </a></br>
                            <a class="btn btn-primary" href="{{ route('todos.edit',$todo->id) }}">
                                <button class="bg-green-800 hover:bg-yellow-800">
                                    Edit
                                </button>
                            </a>
                            <form action="{{ route('todos.destroy',$todo->id) }}" method="POST">

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-800">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</x-app-layout>