<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListarPost extends Component
{
    public $posts;//creo atributo
     //mismo nombre 
    public function __construct($posts)
    {
        //

        $this->posts=$posts;//instanciarlo
        //ya no necesito pasarselo al avista a traves de un return  el ya lo sabe 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        //ya no necesito pasarle la informacion
        return view('components.listar-post');
    }
}
