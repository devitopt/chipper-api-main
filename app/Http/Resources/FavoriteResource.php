<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        if($this->favoriteable_type == Post::class)
            return [
                'id' => $this->favoriteable->id,
                'title' => $this->favoriteable->title,
                'body' => $this->favoriteable->body,
                'user' => new UserResource($this->favoriteable->user),
            ];
        else
            return [
                'id' => $this->favoriteable->id,
                'name' => $this->favoriteable->name,
            ];
    }
}
