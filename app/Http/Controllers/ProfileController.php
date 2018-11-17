<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class ProfileController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth:api');
  }



  public function profileView()
  {
      return view('profile');
  }


  public function edit(Request $request)
  {
    $user = Auth::user();
    $user->name =  $request->name;
    $user->update();
//     return response()->json([
//     'user' => $user,
//
// ]);
     // $this->middleware('auth:api');
    // $user->name=  $request->name;
    // $user->save();
    return $user;
  }



}
