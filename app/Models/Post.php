<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['titulo','descripcion','imagen','user_id'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comentarios():HasMany
    {
        return $this->hasMany(Comentario::class);
    }

    public function likes():HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        return $this->likes->contains('user_id',$user->id);
    }

    public function countLike()
    {
        return $this->likes->count();
    }
}
