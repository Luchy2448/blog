<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {   
        $this->authorize('view', $profile);
        return  view('subscriber.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {   
        $this->authorize('update', $profile);
        $user = Auth::user();
        // dd($request['photo']);
        //si el usuario sube una foto
        if($request->hasFile('photo')){
            //eliminar foto anterior
            File::delete(public_path('storage/'.$profile->photo));
            //aisgnar nueva foto
            $photo = $request['photo']->store('profiles');
         }else{ //si no que deje la foto que encuentra
            $photo = $user->profile->photo;
            }
            //asignar nombre y correo
            $user->full_name = $request->full_name;
            $user->email = $request->email;

            
            //Asignar foto
            $user->profile->photo = $photo;

            //asignar otros campos
            $user->profile->profession = $request->profession;
            $user->profile->about = $request->about;
           


            //Guardar campos de usuario
            $user->save();

            //Guardar campos de perfil
            $user->profile->save();

            return redirect()->route('profiles.edit', $user->profile->id);
    }
    public function destroy(Profile $Profile){
        
    }

    function show(Profile $profile){
    
        $this->authorize('view', $profile);
        $articles = Article::where([
            ['user_id', $profile->user_id], 
            ['status', '1']])->simplePaginate(8);

            $navbar = Category::where([
                ['status', '1'],
                ['is_featured', '1']
            ])->paginate(3);          

            return view('theme-front.subscriber.profiles.show',compact('profile', 'articles', 'navbar'));
        
    }


public function queryArticle(Profile $profile){
    $articles = Article::where([
        ['user_id', $profile->user_id], 
        ['status', '1']])->simplePaginate(8);

        return view('theme-front.subscriber.profiles.show',compact('profile', 'articles'));
}
}


