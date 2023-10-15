<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Like;
use App\Models\Post;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'username'
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
        'password' => 'hashed',
    ];

    //debes de ponerle el nombre de la migracion 
    public function posts()
    {
        //One to many
        //un usuario puede tener muchas publicaciones pero esas publicaciones le pertenecen a un unico usuario
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
       
        //un usuario puede dar muchos likes a cualquier publicacion
        return $this->hasMany(Like::class);
         //para acceder a los likes
    }

    //Almacena los seguidores de un usuario
    public function followers()
    {
             // Un usuario tiene muchos seguidores
             //pertenece a muchos
           return $this->belongsToMany(User::class,'followers','user_id','follower_id');
           //hace referenciaa a la tabla followers 
           //debo de especificar porque me estoy saliendo de la convencion
           //user_id el usuario que estamos visitando 
           //followers la persona q le esta dando follow el autenticado
    }

    //comprobar si un usuario ya sigue a otro
    public function siguiendo(User $user){

        return $this->followers->contains($user->id);
        //accedo al method followers 
        //constains = iterar en toda la collection y buscar si existe ese user id
        //devuelve true or false
        //devuelve true si existe si ha encontrado coincidencia
        //false si no
        //osea devuelve true si ya lo ha seguido
        //false si todavia no lo ha seguido
    }


    //almacenar lo que seguimos
    public function followings()
    {
             // Un usuario puede seguir a muchos
             //pertenece a muchos
           return $this->belongsToMany(User::class,'followers','follower_id','user_id');
           //hace referenciaa a la tabla followers 
           //debo de especificar porque me estoy saliendo de la convencion
           //cambiamos el orden
          
    }
}
