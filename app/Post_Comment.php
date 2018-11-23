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
         return $this->hasMany($this,'parent_id', 'parent_id');
     }


}
