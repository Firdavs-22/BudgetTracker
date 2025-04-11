<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->load("transactions");
        return [
            "id" => $this->id,
            "name" => $this->name,
            "type" => $this->type,
            "color" => $this->color,
            "icon" => $this->icon,
            "transaction_count" => $this->transactions->count(),
            "created_at" => $this->created_at->format("Y-m-d H:i"),
        ];
    }
}
