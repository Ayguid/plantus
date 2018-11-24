<?php

namespace App\Http\Controllers;

// use DB;
use App\Post_Comment;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Auth;
// use App\Traits\ImageHelper;


class PostCommentController extends Controller
{


public function commentList($id)
{
  // return $id;
  $comments = Post_Comment::where('post_id', $id)->where('parent_id', null)->with('allchildren')->get();
  return $comments;
}




}
