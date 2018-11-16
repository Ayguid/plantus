<?php

namespace App\Http\Controllers;

use DB;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageHelper;


class PostController extends Controller
{
  use ImageHelper;

  public function __construct()
  {
      $this->middleware('auth:api',  ['except' => ['indexActivePosts']]);
  }

  public static function indexActivePosts($limit)
  {
    // $posts=Post::where('is_active', true)->where('id','>=', $last_id)->with('images', 'user', 'likes')->take(2)->orderBy("created_at", "desc")->get();
    $posts=Post::where('is_active', true)->with('images', 'user', 'likes', 'category')->take($limit)->orderBy("created_at", "desc")->get();
    return $posts;
  }



  public function store(Request $request)
  {
    return DB::transaction(function () use ($request) {
      $validatedData = Validator::make($request->all(), [
        'content' => 'required|max:255',
        'has_image.*' => 'mimes:jpeg,jpg,gif,bmp,png,webp|max:5000',
        [
        'has_image.*.mimes' => 'Only jpeg,png and bmp images are allowed',
        'has_image.*.max' => 'Sorry! Maximum allowed size for an image is 5MB',
        ]
      ]);
      if ($validatedData->fails())
      {
        $message = $validatedData->errors();
        return  response()->json(['errors' => $message, 422]);
      }
      else
      {
        $post = new Post();
        foreach ($request->input() as $key => $value)
        {
          foreach ($post->getFillable() as $fillable)
          {
            if ($key == $fillable)
            {
              $post->$fillable=$value;
              if ($request->file('has_image') !== null) {
                $post->has_image=true;
              }
            }
          }
          $post->user_id = Auth::user()->id;
          $post->is_active = 1;
        }
        $save=$post->save();
        if ($request->has_image !== null){
          $this->saveImages($request, $post, 'has_image','public/uploads/PostMedia');
        }
        if ($save)
        {
          return  response()->json(['success' => $post::with('images', 'user', 'likes')->find($post->id), 200]);
        }
      }
    });
  }






  public function destroy($id)
  {
  return DB::transaction(function () use ($id) {
    $post = Post::find($id);
    if ($post->images->count() > 0) {
      $this->destroyImages($post, 'public/uploads/PostMedia/');
    }
    $post->images->each->delete();
    $post->likes->each->delete();
    $post->delete();
    });



  }








}
