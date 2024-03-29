<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
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
            'user' => new UserResource(User::find($this->user_id)),
            'title' => $this->title,
            'content' => $this->content,
            'category' => $this->category,
            'created_at' => $this->created_at == null ? null : date('Y-m-d H:i:s', strtotime($this->created_at)),
            'updated_at' => $this->updated_at == null ? null : date('Y-m-d H:i:s', strtotime($this->updated_at)),
        ];
    }
}