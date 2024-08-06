<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\App;

class SkillResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name(App::getLocale()),
            "img"=>asset("uploads/$this->img"),
            "exams"=>ExamResource::collection($this->whenLoaded("exams"))
        ];
    }
}
