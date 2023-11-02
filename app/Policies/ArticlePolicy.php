<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
   
    public function view(User $user, Article $article): bool
    {
        //Revisar si el usuario autenticado es el mismo que creo el articulo
        return $user->id === $article->user_id;
    }

   
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {
        //Revisar si el usuario autenticado es el mismo que creo el articulo
        return $user->id === $article->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article): bool
    {
         //Revisar si el usuario autenticado es el mismo que creo el articulo
         return $user->id ===$article->user_id;
    }

    public function published(?User $user, Article $article){
    
        // Los policy son clases que permiten organizar la lógica de autorización en torno a un modelo o recurso determinado. Tomando como ejemplo el blog, podemos crear un policy para autorizar acciones de usuario como crear o modificar un artículo.

        if($article->status == 1){
            return true;
        }else{
        return false;
    }
    }
}
