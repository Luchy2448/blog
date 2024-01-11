<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // obtener los artículos públicos (1) (TRUE=1) (FALSE=0)
      
        $articles = Article::where('status', '1')
                   ->orderBy('id', 'desc')
                   ->simplePaginate(10);
        // Obtener las categorías con estado público (1) y destacadas (1)
        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1']
        ])->paginate(3);          
//   dd('ok');
    //    traeme al usuario logeado
        // $user = Auth::user(); 
        // dd($user->profile);        
        // return view('home.index', compact('articles', 'navbar'));
        return view('theme-front.home', compact('articles', 'navbar'));
    }
    //Todas las categorías
    public function all(){
        $categories = Category::where('status', '1')
                   ->simplePaginate(20);
    // Obtener las categorías con estado público (1) y destacadas (1)
    $navbar = Category::where([
        ['status', '1'],
        ['is_featured', '1']
    ])->paginate(3);    
    
    return view('home.all-categories', compact('categories', 'navbar'));
    }
}