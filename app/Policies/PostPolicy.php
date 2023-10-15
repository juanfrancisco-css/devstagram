<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    /*
    Tiene asociado un modelo por defecto que es user 
    ademas puedes asociarle un modelo de tu preferencia
    Permite al usuario poder ver o eliminar o update 
    dar permisos 
    */

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post)
    {
        //devuelve true or false
        //evitar duplicados
        return $user->id === $post->user_id;
        //devuelve true si es suyo
    }

    
}
