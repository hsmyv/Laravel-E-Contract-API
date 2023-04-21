<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllDraftsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($draft) {
            return [
                'id' => $draft->id ?? null,
                'name' => $draft->name ?? null,
                'body' => $draft->body ?? null,
                'created_at' => $draft->created_at ? $draft->created_at->format(' M D Y') : null,
                'user' => [
                    'id' => $draft->user ? $draft->user->id : null,
                    'name' => $draft->user ? $draft->user->name : null,
                ]
            ];
        });
    }
}
