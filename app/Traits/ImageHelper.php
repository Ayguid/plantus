<?php

namespace App\Traits;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Illuminate\Support\Facades\Auth;

trait ImageHelper
{


  public function saveImages($request, $who, $form_key, $where)
  {
    foreach ($request->file($form_key) as $key => $image)
    {
      $newImage= new Image();
      $file_name = md5(uniqid() . time()) . '.' . $image->getClientOriginalExtension();
      $newImage->image_path=$file_name;
      $newImage->user_id=Auth::user()->id;
      if ($who->images()->save($newImage) && $image->storeAs($where, $file_name))
      {
        $status = true;
      }else
      {
        $status = false;
      }
    }
    return $status;
  }



  public function destroyImages($who, $where)
  {
    foreach ($who->images as $image)
    {
      if (Storage::delete($where.$image->image_path))
      {
        $status = true;
      }else
      {
        $status = false;
      }
    }
    return $status;
  }









}
