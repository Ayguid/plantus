<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;

class Post_Like extends Model
{
  protected $table='posts_likes';

  protected $fillable = ['user_id', 'post_id'];


 public function post()
 {
   return $this->belongsTo(Post::class);
 }


 public function user()
 {
   return $this->belongsTo(User::class);
 }

}
