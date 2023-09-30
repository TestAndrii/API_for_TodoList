<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Todo') }}
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

                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                    @csrf

                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Title:</strong>
                                <input type="text" name="title" class="form-control" value="{{ $todo->title }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Status:
                                    <select name="status">
                                        <option value="{{ $todo->status }}">{{ $statuses[$todo->status] }}
                                        @if (!$todo->status)
                                        <option value="{{ 1 }}">{{ $statuses[1] }}</option>
                                        @endif
                                    </select>
                                </strong>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Priority:
                                    <select name="priority">
                                        <option value="{{ $todo->priority }}">{{ $todo->priority }}</option>
                                        @for ($i = $prioritys[0]; $i <= $prioritys[1]; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </strong>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Subtask:
                                    <select name="subtask">
                                        <option value="{{ $todo->subtask }}">{{ $todo->subtask }}</option>
                                        <option value="">null</option>
                                        @foreach($subtasks as $s)
                                        <option value="{{ $s->id }}">{{ $s->id }}</option>
                                        @endforeach
                                    </select>
                                </strong>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>