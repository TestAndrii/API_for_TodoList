<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::tasks(Auth::id());
        return view('todos.index', [
            'todos' => $todos,
            'statuses' => Todo::STATUS
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todos.create',[
            'prioritys' => Todo::PRIORITY,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'priority' => 'required',
            'title' => 'required'
        ]);

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->priority = $request->priority;
        $todo->user_id = Auth::id();
        $todo->save();

        return redirect()->route('todos.index')->with('success','Todo created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $todo = Todo::id($id,Auth::id());
        return view('todos.show', [
            'todo' => $todo,
            'statuses' => Todo::STATUS
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $todo = Todo::findOrFail($id);
        return view('todos.edit', [
                'todo' => $todo,
                'statuses' => Todo::STATUS,
                'prioritys' => Todo::PRIORITY,
                'subtasks' => Todo::tasks(Auth::id())
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'priority' => 'required',
            'title' => 'required'
        ]);
        $todo = Todo::find($id);
        $todo->update($request->all());

        // test status
        if(Todo::subtaskDone($id))
        {
            $todo->completedAt = now();
        } else
            $todo->status = 0;
        $todo->save();

        return redirect()->route('todos.index')->with('success','Todo updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = Todo::find($id);
        if (!$todo->status) {
            $todo->delete();
            return redirect()->route('todos.index')->with('success','Todo deleted successfully.');
        }
        return redirect()->route('todos.index')->with('success','Todo deleted ERROR. Delete subtask.');

    }
}
