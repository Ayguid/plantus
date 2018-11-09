<?php

namespace App;

use App\User;
use App\Image;
use App\Post_Like;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{



  protected $guard = 'posts';

  protected $fillable = [
    'user_id', 'group_id', 'has_image', 'content', 'location', 'is_active',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */


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

}
