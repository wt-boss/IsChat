<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Chat extends Model
{
    use HasFactory;

    public function messages():HasMany{

        return $this->hasMany(Message::class);
     }

     public function users():BelongsToMany{

        return $this->belongsToMany(User::class);
     }
}
