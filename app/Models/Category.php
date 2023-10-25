<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = ['name', 'slug', 'status', 'is_featured', 'image'];
    // protected $guarder = ['id', 'created_at', 'updated_at' ];
     //Relacion de uno a muchos (category-article)
     public function articles(){
        return $this->hasMany(Article::class);
     }

     //Utilizar el slug en lugar del id
     public function getRouteKeyName()
     {
     return 'slug';
     }
 }
