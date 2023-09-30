<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'priority',
        'title',
        'createdAt',
        'completedAt',
        'subtask',
        'user_id',
    ];

    const PRIORITY = [1,5];
    const STATUS = ['todo', 'done'];

    /**
     * @return User
     */
    public function User(): User
    {
        return $this->hasOne(User::class);
    }

    /**
     * Поиск Task по id & user_id
     * @param  int  $id
     * @param  int  $user_id
     * @return Todo
     */
    public static function id(int $id, int $user_id): Todo
    {
        return Todo::where('id',$id)
                    ->where('user_id',$user_id)
                    ->first();
    }

    /**
     *  Все Tasks пользователя (для справочника)
     * @param $user_id
     */
    public static function tasks($user_id)
    {
        return Todo::where('user_id', $user_id)->get();
    }

    /**
     *  Проверка наличия незавершённых Subtsak.
     * @param $subtask_id
     * @return bool  (true - есть. false - нет.)
     */
    public static function subtaskTodo($subtask_id): bool
    {
        // no subtask
        if ($subtask_id === null) {
            return true;
        }

        $task = Todo::findOrFail($subtask_id);

        if($task) {
            return ($task->status <> 0);
        }
        return false;
    }
}
