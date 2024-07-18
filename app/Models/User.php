<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Follower;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setUsernameAttribute( $value)
    {
        $this->attributes['username'] = Str::slug(Str::lower($value));
    }

    public function posts():HasMany
    {
        return $this->hasMany(Post::class);
    }

     // Almacena los seguidores de este usuario (this).

     public function followers():BelongsToMany
     {
         return $this->belongsToMany(User::class,'followers','user_id','follower_id');
     }

    // Este usuario (this) sigue a muchos usuarios (User::class).
    public function following()
    {
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    /* Verifica si el modelo sigue al modelo User pasado como parámetro. */
    public function is_follower(User $user)
    {
       return Follower::where('follower_id',$this->id)->where('user_id',$user->id)->get()->count();
    }

}
