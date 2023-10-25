<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   // otra forma de acceder a las tablas de la base de datos DB::table('')
        $comments = DB::table('comments')
                 ->join('articles', 'comments.article_id', '=', 'articles_id')
                 ->join('users', 'comments.user_id', '=', 'users.id')
                 ->select('comments.value', 'comments.description', 'articles.title', 'users.full_name')
                 ->where('articles.user_id', '=', Auth::user()->id)
                 ->orderBy('articles.id', 'desc')
                 ->get();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)

    {
        //  dd($request->all());
        //Verificar si en el artículo ya existe un comentario del usuario
        $result = Comment::where('user_id', Auth::user()->id)   //con esta variable estamos diciendo que nos traiga todos los comentarios de la persona que se encuetra autenticada (usuarios)
                            ->where('article_id', $request->article_id)->exists();
                            // dump($result);
        //Consulta para  obtener el slug y estado del artículo comentado
        $article = Article::select('status', 'slug')->find($request->article_id);
        
        //Si no existe y su el estado del artículo es público, comentar.
        if(!$result and $article->status == 1){
            // dump('if');
            Comment::create([
                'value' => $request->value,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
                'article_id' => $request->article_id,
            ]);
            // dd('finish1');
            
            return redirect()->action([ArticleController::class, 'show'], [$article->slug]);
        }else{
            // dd('finish2');
            return redirect()->action([ArticleController::class, 'show'], [$article->slug])
                             ->with('success-error', 'Solo puedes comentar una vez');
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Comment $comment)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
      $comment->delete();
      
      return redirect()->action([CommentController::class, 'index'], compact('comments'))
             ->with('success-delete', 'Comentario eliminado con éxito');
    }
}
