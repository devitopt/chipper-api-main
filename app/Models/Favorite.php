<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['favoriteable_id', 'favoriteable_type', 'user_id'];

    public function favoriteable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'favoriteable_type', 'favoriteable_id');
        // return $this->morphTo();
    }
}
