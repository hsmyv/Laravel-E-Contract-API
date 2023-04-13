<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AllContractsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($contract) {
            return [
                'id' => $contract->id ?? null,
                'name' => $contract->name ?? null,
                'body' => $contract->body ?? null,
                'created_at' => $contract->created_at ? $contract->created_at->format(' M D Y') : null,
                'user' => [
                    'id' => $contract->user ? $contract->user->id : null,
                    'name' => $contract->user ? $contract->user->name : null,
                ]
            ];
        });
    }

}
