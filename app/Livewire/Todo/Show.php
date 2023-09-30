<?php

namespace App\Livewire\Todo;

use App\Models\Todo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $todos, $tasks;
    public $id, $status, $priority, $title, $createdAt, $completedAt, $subtask, $user_id;

    // Modal Windows
    public bool $updateTodo = false,
        $createTodo = false;

    // Filter & search
    public string $title_search = '',
        $filter_status = '', $filter_priority = '';

    // Sorting
    public string $flagSort = '',
        $cratedAtSort = 'desc',
        $completedAtSort = 'desc',
        $prioritySort = 'desc';

    // Dictionary for forms
    public array $PRIORITY = Todo::PRIORITY;
    public array $STATUS = Todo::STATUS;

    public function render()
    {
        $q = Todo::query();
        // только мои задания
        $q->where('user_id',Auth::id());

        // Поиск
        $q->where('title','LIKE','%'.$this->title_search.'%');
        $q->where('status', 'LIKE', '%'.$this->filter_status.'%');
        $q->where('priority', 'LIKE', '%'.$this->filter_priority.'%');

        // Сортировка
        switch ($this->flagSort) {
            case 'created':
                $q->orderBy('createdAt',$this->cratedAtSort);
                break;
            case 'completed':
                $q->orderBy('completedAt', $this->completedAtSort);
                break;
            case 'priority':
                $q->orderBy('priority',$this->prioritySort);
                break;
        }

        $this->todos = $q->get();
        return view('livewire.todo.show');
    }

    /**
     * Clear form
     * @return void
     */
    public function resetFields(): void
    {
        $this->status = 0;
        $this->priority = Todo::PRIORITY[0];
        $this->title = '';
        $this->createdAt = null;
        $this->completedAt = null;
        $this->subtask = null;
        $this->user_id = Auth::id();
        //
        $this->updateTodo = false;
        $this->createTodo = false;
    }

    /**
     * Save new TODO
     * @return void
     */
    public function save(): void
    {
        $validated = $this->validate([
            'title' => 'required|min:3',
            'priority' => 'required',
            'createdAt' => 'required',
            'status' => 'required'
        ]);
        $validated['user_id'] = Auth::id();

       Todo::create($validated);

        // Set Flash Message
        session()->flash('success','Todo Created Successfully!!');

        // Reset Form Fields After Creating todo
        $this->resetFields();
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $this->resetFields();
        $this->createdAt = Carbon::today()->format('Y-m-d');
        $this->createTodo = true;
    }

    /**
     * @param $id
     * @return void
     */
    public function edit($id): void
    {
        $todo = Todo::findOrFail($id);
        $this->id = $id;
        $this->priority = $todo->priority;
        $this->status = $todo->status;
        $this->title = $todo->title;
        $this->createdAt = Carbon::create($todo->createdAt)->format('Y-m-d');
        $this->completedAt = Carbon::create($todo->completedAt)->format('Y-m-d');
        $this->subtask = $todo->subtask;
        $this->user_id = $todo->user_id;
        //
        $this->tasks = Todo::tasks(Auth::id());
        $this->updateTodo = true;
    }

    /**
     * Update TODO
     * @return void
     */
    public function update(): void
    {
        $validated = $this->validate([
            'title' => 'required|min:3',
            'priority' => 'required',
            'createdAt' => 'required',
            'status' => 'required'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['completedAt'] = $this->completedAt;
        $validated['subtask'] = $this->subtask;
        // validate status & completedAt
        $validated['status'] = Todo::subtaskTodo($this->subtask) ? $this->status : 0;
        $validated['completedAt'] = $validated['status'] ? $validated['completedAt'] : null;

        Todo::find($this->id)
            ->fill($validated)
            ->save();

        // Set Flash Message
        session()->flash('success','Todo Updated Successfully!!');

        // Reset Form Fields After Creating todo
        $this->resetFields();
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteTodo($id): void
    {
        $todo = Todo::find($id);

        if($todo->subtask > 0)
        {
            session()->flash('error',"Something goes wrong while deleting task!!");
        } else {
            $todo->delete();
            session()->flash('success',"Task Deleted Successfully!!");
        }
    }

    /**
     * Изменение порядка сортировки
     * @param  string  $field
     * @return void
     */
    public function Sorting(string $field): void
    {
        switch ($field)
        {
            case 'created':
                $this->cratedAtSort = $this->cratedAtSort == 'desc' ? 'asc' : 'desc';
                break;
            case 'completed':
                $this->completedAtSort = $this->completedAtSort == 'desc' ? 'asc' : 'desc';
                break;
            case 'priority':
                $this->prioritySort = $this->prioritySort == 'desc' ? 'asc' : 'desc';
                break;
        }
        $this->flagSort = $field;
    }
}
