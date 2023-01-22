<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Language\LanguageResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'languages' => [
                'source' => new LanguageResource($this->sourceLanguage),
                'target' => LanguageResource::collection(
                    $this->targetLanguages()
                )
            ],
            'documents' => [], // TODO
            'performers' => [], // TODO
            'settings' => [
                'useMachineTranslate' => $this->use_machine_translate
            ],
            'createdAt' => Carbon::parse($this->created_at)->format('d-m-Y H:i'),
        ];
    }
}
