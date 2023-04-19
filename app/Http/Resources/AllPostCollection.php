<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllPostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($post) {
            return [
                'id' => $post->id,
                'text' => $post->text,
                'video' => url('/') . $post->video,
                'created_at' => $post->created_at->format(' M D Y'),
                'user' => [
                    'id' => $post->user->id,
                    'name' => $post->user->name,
                    'image' => url('/') . $post->user->image
                ]
            ];
        });

    }
}
