<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Post_Like;
use Illuminate\Support\Facades\Auth;

class PostLikeController extends Controller
{




  public function __construct()
  {
    $this->middleware('auth:api');
  }




  public function likePost(Request $request, $id)
  {
    $user_id = Auth::user()->id;
    $postLike = Post_like::where('user_id', $user_id)->where('post_id', $id)->first();
    $post_like = new Post_Like();

    if ($postLike == null ) {
      $post_like->user_id = $user_id;
      $post_like->post_id = $id;
      $post_like->save();
      return response('saved', 200)->header('Content-Type', 'text/plain');
    }
    else {
      $postLike->delete();
      return response('deleted', 200)->header('Content-Type', 'text/plain');
    }

  }






}
