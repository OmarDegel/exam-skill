<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ExamResource;

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
            "name_en"=>$this->id,
            "name_ar"=>$this->id,
            "img"=>asset("uploads/$this->img"),
            "exams"=>ExamResource::collection($this->whenLoaded("exams"))
        ];
    }
}
