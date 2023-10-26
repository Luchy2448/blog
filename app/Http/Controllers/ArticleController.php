<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mostrar los artículos en el admin
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)
                   ->orderBy('id', 'desc')
                   ->simplePaginate(10);
        return view('admin.articles.index', compact('articles'));           
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Obtener  categorías públicas
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get();
        return view('admin.articles.create', compact('categories'));                           
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
           /* 
        Formulario:

        1. Título = "Articulo 1"
        2. Slug = "articulo-1"
        3. Introduction = "Este es el primer artículo"
        4. Image = "foto.png"
        5. Body = "Primer artículo del curso"
        6. Status = 1
        8. Category_id = 3
        */
        $request->merge([
            'user_id' => Auth::user()->id,
        ]);
        //Guardo la solicitud en una variable
        $article = $request->all();

        //Validar si hay un archivo en el request
        if($request->hasFile('image')){
            $article['image'] = $request->file('image')->store('articles');
        }
        // echo '<pre>';
        // var_dump($article);
        // echo '</pre>';
        // exit;

        Article::create($article);

        return redirect()->action([ArticleController::class, 'index'])
                            ->with('success-create', 'Artículo creado con éxito');
        // $request->merge([
        //     'user_id' => Auth::user()->id,
        // ]);
    
        // // Validar si hay un archivo en el request
        // if ($request->hasFile('image')) {
        //     $article['image'] = $request->file('image')->store('articles');
        // }
    
        // // Utiliza el método create() para guardar el artículo en la base de datos
        // Article::create($article);
    
        // return redirect()->action([ArticleController::class, 'index'])
        //                 ->with('success-create', 'Artículo creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $this->authorize('published', $article);
        $comments = $article->comments()
        ->with('user')// Carga la relación 'user'
        ->simplePaginate(5);
    
    //    dd($comments->first());
       return view('subscriber.articles.show', compact('article', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {   
        $this->authorize('view', $article);
        
        //Obtener  categorías públicas
        $categories = Category::select(['id', 'name'])
                                ->where('status', '1')
                                ->get();
        return view('admin.articles.edit', compact('categories', 'article'));     
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);
      //si el usuario sube una nueva imagen
      if($request->hasFile('image')){
           //entonces eliminar la imagen anterior
           File::delete(public_path('storage/' .$article->image));
           //ahora que la nueva imagen se asigne
           $article['image'] = $request->file('image')->store('articles');

        }
        //Actualizar datos
        $article->update([
            'title' => $request->title, 
            'slug' => $request->slug,
            'introduction' => $request->introduction,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'status' => $request->status,
        ]);
        return redirect()->action([ArticleController::class, 'index'])
                            ->with('success-update', 'Artículo modificado con éxito');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)

    {
        $this->authorize('delete', $article);
        //Eliminar imagen del artículo
        if($article->image){
            File::delete(public_path('storage/' .$article->image));
        }
        //Eliminar artículo
        $article->delete();
        return redirect()->action([ArticleController::class, 'index'], compact('article'))
        ->with('success-delete', 'Artículo eliminado con éxito');
    }
}
