<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
            'user' => new UserResource($this->user),
            'categories' => new CategoryResource($this->category),
            'tags' => TagResource::collection($this->tags),
            'foo' => 'bar'
        ];
    }
}
