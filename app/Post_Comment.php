<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Post_Comment extends Model
{
  protected $table='post_comments';


      public function post()
     {
         return $this->belongsTo(Post::class, 'id', 'post_id');
     }

     public function children()
     {
         // return $this->hasMany($this,'parent_id')->where('parent_id', true);
         return $this->hasMany($this,'parent_id');
     }

     public function allchildren()
     {
         // return $this->hasMany($this,'parent_id')->where('parent_id', true);
         // return $this->hasMany(Post_Comment::class,'parent_id');
         return $this->children()->with('allchildren');
     }
}
