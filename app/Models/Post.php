<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
//Es la ifnormacion que se llenara en la bbdd 
//para que laravel sepa que es lo que tiene que leer
//y que informacion tiene que procesar
//para poder manipular
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

 //debes de ponerle el nombre de la migracion 
    public function user()
    {

        //belongs to
        //Una publicacion le pertenece un unico usuario
        //me saca toda la informacion pero si quiero q me sace unos campos concretos
        return $this->belongsTo(User::class)->select(['name','username']);

    }
//un post tiene muchos comentarios
    //debes de ponerle el nombre de la migracion
    public function comentarios()
    {

        //Un post tiene muchos comentarios 
         return $this->hasMany(Comentario::class);
         //para acceder a los comentarios
    }


    //un post tiene muchos likes
    public function likes()
    {

        return $this->hasMany(Like::class);
         //para acceder a los likes
    }

    //method para evitar duplicados de likes
    //en una publicacion duplicados de likes
    public function checkLike(User $user)
    {
         /*
         $this->likes = Me situa en la tabla 'LIKE'
           contains    = Revisa la informacion de la columna que yo le paso por parametros
           esta tabla de aqui contiene en la columna de user_id este usuario
         */
       
        return $this->likes->contains('user_id',$user->id);//evitar duplicados
        //devuelve true si existe ya
        //false si todavia no
    }
}
