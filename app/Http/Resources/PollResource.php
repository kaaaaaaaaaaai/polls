<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class PollResource
 * @package App\Http\Resource
 * @property Carbon updated_at
 */
class PollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "updated_at" => $this->updated_at->format("Y-m-d h:m:i"),
            "title" => $this->title,
            "totalVote" => $this->countVote(),
//            "questions" => QuestionResource::collection($this->question)
            "questions" => QuestionResource::collection($this->whenLoaded('question'))
        ];
    }
}
