<?php

namespace App\Http\Resources;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'priority' => $this->priority,
            'title' => $this->title,
            'description' => $this->description,
            'createdAt' => $this->createdAt,
            'completedAt' => $this->completedAt,
            'subtask' => new TodoResource($this::find($this->subtask)),
        ];
//            return parent::toArray($request);
    }
}
