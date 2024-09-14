<?php

namespace App\Http\Resources\admin\auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminLoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->username,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'date_of_birth' => $this->date_of_birth,
            'role' => [
                'role_id' => $this->role_id,
                'role_name' => $this->role->name,
                'role_description' => $this->role->description,
            ],
        ];
    }
}
