<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Follower extends Model
{
    protected $table = 'user_following';


    protected $fillable = [
      'following_user_id', 'follower_user_id', 'allow',
    ];



}
