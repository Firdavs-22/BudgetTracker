<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $this->load("accounts");
        return [
            "id" => $this->id,
            "name" => $this->name,
            "username" => $this->username,
            "accounts" => AccountSelectResource::collection($this->accounts),
        ];
    }
}
