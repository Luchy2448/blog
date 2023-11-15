<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Profile;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //Eliminar carpetas articles
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');
       

        //Crear carpeta donde se almacenaran las imagenes
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');
       
        //llamar al seeder //primero el role y despues el user siempre
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        
        
        //llamando Factories
        Category::factory(8)->create();
        Article::factory(20)->create();
        Comment::factory(20)->create();
        
    }
}
