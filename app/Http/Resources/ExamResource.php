<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\QueResource;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "name"=>$this->name(App::getLocale()),
            "description"=>$this->desc(App::getLocale()),
            "img"=>asset("uploads/$this->img"),
            "question_no"=>$this->question_no,
            "difficulty"=>$this->difficulty,
            "duration_mins"=>$this->duration_mins,
            "questions"=>QueResource::collection($this->whenLoaded("questions"))
        ];
    }
    
}
