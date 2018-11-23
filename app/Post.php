<?php

namespace App;

use App\User;
use App\Image;
use App\Post_Like;
use App\Post_Category;
use App\Post_Comment;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{



  protected $guard = 'posts';

  protected $fillable = [
    'user_id', 'post_category_id', 'has_image', 'content', 'location', 'is_active',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */

  //relations
  public function category()
  {
    return $this->hasOne(Post_Category::class, 'post_category_id', 'post_category_id');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function images()
  {
    return $this->hasMany(Image::class);
  }


  public function likes()
  {
    return $this->hasMany(Post_Like::class);
  }

  public function postComments()
  {
    return $this->hasMany(Post_Comment::class);
  }




}
