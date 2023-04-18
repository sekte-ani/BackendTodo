<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteDetailResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'kategori_id' => $this->kategori_id,
            'kategori' => $this->whenLoaded('kategori'),
            'created_at' => date_format($this->created_at, "d/m/Y H:i"),
        ];
    }
}
