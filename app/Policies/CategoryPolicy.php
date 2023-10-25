<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function published(User $user, Category $category){
        if($category->status ==1 ){
            return true;
        }else{
            return false;
        }
    }
}
