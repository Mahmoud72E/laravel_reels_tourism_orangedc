<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'reelName' => $this->title,
          'notes' => $this->description,
          'reelPath' => $this->reel_path,
          'placeId' => $this->place_id,
          'hashtags' => $this->tags,
        ];
    }
}
