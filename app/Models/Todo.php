<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'done',
        'priority',
        'title',
        'createdAt',
        'completedAt',
        'subtask',
        'user_id',
    ];

    public function User()
    {
        return $this->hasOne(User::class);
    }
}
