<?php

namespace App\Http\Resources\Document;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class MinifiedDocumentResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status(),
            'progress' => $this->progress,
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y H:i'),
        ];
    }
}
