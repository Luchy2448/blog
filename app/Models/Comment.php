<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model


{
  protected $fillable = ['value', 'description', 'article_id', 'user_id', 'id'];
   
    use HasFactory;
    // protected $guarder = ['id', 'created_at', 'updated_at' ];
     //Relacion de uno a muchos inversa (comment-user)
     public function user(){
        // return $this->belongsTo(Comment::class);
        {
          return $this->belongsTo(User::class, 'user_id'); // Asegúrate de especificar la clave foránea 'user_id'
      }
      
     }
      //Relacion de uno a muchos inversa (comment-article)
      public function article(){
        return $this->belongsTo(Article::class);
      }
}
