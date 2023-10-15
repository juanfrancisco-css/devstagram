<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];


    //invoco a la tabla user
    public function user()
    {
        //comentario solo puede pertenecer a una persona/usuario
        return $this->belongsTo(User::class);
    }
}
