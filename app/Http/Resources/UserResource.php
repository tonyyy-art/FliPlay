<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,

            'animes' => AnimeResource::collection(
                $this->whenLoaded('animes')
            ),

            'mangas' => MangaResource::collection(
                $this->whenLoaded('mangas')
            ),
        ];
    }
}
