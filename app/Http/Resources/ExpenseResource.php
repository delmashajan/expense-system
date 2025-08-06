<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            'amount' => $this->amount,
            'description' => $this->description,
            'status' => $this->status,
            'receipt_url' => $this->receipt 
                ? asset('storage/' . $this->receipt->file_path) 
                : null,
            'created_at' => $this->created_at->toDateTimeString(),
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ]
        ];
    }
}
