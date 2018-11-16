<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post_Category;

class Post_CategoriesController extends Controller

{

  public function __construct()
  {
      $this->middleware('auth:api',  ['except' => ['indexCategories']]);
  }



public static function indexCategories()
{
  $categories = Post_Category::all();
  return $categories;
}












}
