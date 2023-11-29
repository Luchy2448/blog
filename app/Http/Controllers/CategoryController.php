<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    //Protejer rutas
    public function __construct(){
        $this->middleware('can:categories.index')->only('index');
        $this->middleware('can:categories.create')->only('create', 'store');
        $this->middleware('can:categories.edit')->only('edit', 'update');
        $this->middleware('can:categories.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Mostrar categorias en el admin
        $categories = Category::orderBy('id', 'desc')
                              ->simplePaginate(8);
                              
        return view('admin.categories.index', compact('categories'));                      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = $request->all();

        //Validar si hay un archivo
        if($request->hasFile('image')){
            $category['image'] = $request->file('image')->store('categories');
        } 
        // echo '<pre>';
        // var_dump($category);
        // echo '</pre>';
        // exit;
        //Guardar informacion
        Category::create($category);
        
        //Redireccionar
        return redirect()->action([CategoryController::class, 'index'])
              ->with('success-create', 'Categoría creada con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
       return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        //si el ususario sube una imagen 
        if($request->hasFile('image')){
            //eliminar imagen anterior
            File::delete(public_path('storage/' .$category->image));
            //Asignamos la nueva imagen
            $category['image'] = $request->file('image')->store('categories');
        }
        //Actualizar datos
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'status' => $request->status,
            'is_featured' => $request->is_featured,
        ]);
        return redirect()->action([CategoryController::class, 'index'], compact('category'))
        ->with('success-update', 'Categoría modificada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //Elimar imagen de la categoria
        if($category->image){
            File::delete(public_path('storage/' .$category->name));            
        }
        $category->delete();

        return redirect()->action([CategoryController::class, 'index'], compact('category'))
        ->with('success-delete', 'Categoría eliminada con éxito');
    }

    //metodo para filtar articulos por categorias
    public function detail(Category $category){

        $this->authorize('published', $category);
        $articles = Article::where([
            ['category_id', $category->id],
            ['status', '1']
        ])
            ->orderBy('id', 'desc')
            ->simplePaginate(5);

        $navbar = Category::where([
            ['status', '1'],
            ['is_featured', '1'],
        ])->paginate(3); 
        return view('subscriber.categories.detail', compact('articles', 'category', 'navbar'));   
    }
}
