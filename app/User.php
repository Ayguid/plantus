<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use App\User_Follower;



class User extends Authenticatable implements MustVerifyEmail
{
  use HasApiTokens, Notifiable;
  // use Notifiable;

  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];




  public function iFollow()
  {
    return $this->hasManyThrough(User::class, User_Follower::class, 'follower_user_id', 'id', 'id', 'following_user_id');
  }



  public function myFollowers()
  {
    return $this->hasManyThrough(User::class, User_Follower::class, 'following_user_id', 'id', 'id', 'follower_user_id');
  }






  //functions
  public function followCount($relation)
  {
    return $this->$relation()->count();
  }

}
