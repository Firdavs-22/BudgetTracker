<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "pagination" => [
                "current_page" => $this->currentPage(),
                "last_page" => $this->lastPage(),
                "per_page" => $this->perPage(),
                "total" => $this->total(),
                "links" => $this->getUrlRange(1, $this->lastPage()),
            ],
            "meta" => [
                "first_page_url" => $this->url(1),
                "last_page_url" => $this->url($this->lastPage()),
                "prev_page_url" => $this->previousPageUrl(),
                "next_page_url" => $this->nextPageUrl(),
            ]
        ];
    }
}
