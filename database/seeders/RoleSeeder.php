<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Roles
        $admin = Role::create(['name' => 'Administrator']);
        $author = Role::create(['name' => 'Author']);

        //Permisos
        Permission::create(['name' => 'admin.index',
                               'description' => 'Ver el dashboard'])->syncRoles([$admin, $author]);
        //Categorias 
        Permission::create(['name' => 'categories.index',
                               'description' => 'Ver categorías'])->syncRoles([$admin, $author]);

        Permission::create(['name' => 'categories.create',
                               'description' => 'Crear categorías'])->assignRole($admin);

        Permission::create(['name' => 'categories.edit',
                               'description' => 'Editar categorías'])->assignRole($admin);  

        Permission::create(['name' => 'categories.destroy',
                               'description' => 'Eliminar categorías'])->assignRole($admin);  
                               
        //Articulos
        Permission::create(['name' => 'articles.index', 
                               'description' => 'Ver artículos'])->syncRoles([$admin, $author]);     
        
        Permission::create(['name' => 'articles.create', 
                               'description' => 'Crear artículos'])->syncRoles([$admin, $author]);          
                               
        Permission::create(['name' => 'articles.edit', 
                               'description' => 'Editar artículos'])->syncRoles([$admin, $author]); 

        Permission::create(['name' => 'articles.destroy', 
                               'description' => 'Eliminar artículos'])->syncRoles([$admin, $author]); 

         //Comentarios
        Permission::create(['name' => 'comments.index', 
                               'description' => 'Ver comentarios'])->syncRoles([$admin, $author]);     

        Permission::create(['name' => 'comments.destroy', 
                               'description' => 'Eliminar comentarios'])->syncRoles([$admin, $author]);                        
    }
}
