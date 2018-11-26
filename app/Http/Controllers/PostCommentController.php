<?php

namespace App\Http\Controllers;

// use DB;
use App\Post;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Auth;
// use App\Traits\ImageHelper;


class PostCommentController extends Controller
{


public function commentList($id)
{
  $comments = Post::where('parent_id', $id)->with('allchildren')->get();
  return $comments;
}




}
