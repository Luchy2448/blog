<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
{   /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Profile $profile): bool
    {
        //Revisar si  el usuario autenticado esta viendo su perfil
    return $user->id === $profile->user_id;
    }
    public function update(User $user, Profile $profile){
        //REVISAR SI EL USUARIO AUTENTICADO ESTA ACTUALIZANDO SU PERFIL
        return $user->id === $profile->user_id;
    }
   
}
