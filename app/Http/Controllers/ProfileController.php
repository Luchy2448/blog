<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return  view('subscriber.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        $user = Auth::user();

        //si el usuario sube una foto
        if($request->hasFile('photo')){
            //eliminar foto anterior
            File::delete(public_path('storage/' .$profile->photo));
            //aisgnar nueva foto
            $photo = $request['photo']->store('profiles');
         }else{ //si no que deje la foto que encuentra
            $photo =$user->profile->photo;
            }
            //asignar nombre y correo
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            //Asignar campos adicionales 
            $user->profile->profession = $request->profession;
            $user->profile->about = $request->about;
            $user->profile->photo = $photo;
            $user->profile->twitter = $request->twitter;
            $user->profile->linkedin = $request->linkedin;
            $user->profile->facebook = $request->facebook;

            //Guardar campos de usuario
            //save the user fields
            $user->save();



  
            
            //Guardar campos de perfil

            $user->profile->save();

            return redirect()->route('profiles.edit', $user->profile->id);
    }
    public function destroy(Profile $Profile){
        
    }
public function queryArticle(Profile $profile){
    $articles = Article::where([
        ['user_id', $profile->user_id], 
        ['status', '1']])->simplePaginate(8);

        return view('subscriber.profiles.show',compact('profile', 'articles'));
}
}


