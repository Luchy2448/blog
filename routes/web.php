<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Principal
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');
//Admin
Route::get('/admin', [AdminController::class, 'index'])
                                         ->middleware(['can:admin.index'])
                                         ->name('admin.index');

/*                
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
*/

//Rutas del admin
 Route::middleware(['auth'])->group(function () {
    Route::namespace('App\Http\Controllers')->prefix('admin')->group(function () {

        //Articulos
        Route::resource('articles', 'ArticleController')
                ->except('show')
                ->names('articles');


        //Categorias

        Route::resource('categories', 'CategoryController')
        //queremos que nos cree todas las rutas excepto SHOW.
                    ->except('show')
                    ->names('categories');
                                

        //Comentarios

        Route::resource('comments', 'CommentController')
                        ->only('index', 'destroy')
                        ->names('comments');

        //Usuarios
        Route::resource('users', 'UserController')
                       ->except( 'create', 'store','show')
                       ->names('users');

        //Roles
          Route::resource('roles', 'RoleController')
                       ->except('show')
                       ->names('roles');

        //Perfiles

        // Route::resource('profiles', 'ProfileController')
        //                 ->only('edit', 'update', 'show')
        //                 ->names('profiles');

                        Route::get('profiles', 'ProfileController@index')->name('profiles.index');
                        Route::get('profiles/create', 'ProfileController@create')->name('profiles.create');
                        Route::get('profiles/{profile}/edit', 'ProfileController@edit')->name('profiles.edit');
                        Route::get('profiles/{profile}', 'ProfileController@show')->name('profiles.show');
                        Route::put('profiles/{profile}', 'ProfileController@update')->name('profiles.update');
                        Route::delete('profiles/{profile}', 'ProfileController@destroy')->name('profiles.destroy');


        Route::get('/profiles/{profiles}', [ProfileController::class, 'queryArticle'])->name('profiles.queryArticle');  


        //Ver artículos   
        Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');     


        //Ver artículos por categorías
        Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

        //Guardar los comentarios         
        Route::post('/comment', [CommentController::class, 'store'])->name('comments.store'); 
        
        //
        
});


}); 
Auth::routes(); 