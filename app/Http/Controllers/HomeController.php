<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use App\Models\cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   

    public function home(){
        $data=product::all();
        if(Auth::id()){
          $user = Auth::user();
          $userid = $user->id;
          $count = cart::where('user_id',$userid)->count();
        }
        else{
          $count = 0;
        }
        return view('home.index',compact('data','count'));
    }

  public function detail($id){
    $data=product::findOrFail($id);
    if(Auth::id()){
      $user = Auth::user();
      $userid = $user->id;
      $count = cart::where('user_id',$userid)->count();
    }
    else{
      $count = 0;
    }
  return view('home.detail',compact('data','count'));

  }

  public function addcart($id){
     $product_id = $id;
     $user = Auth::user();
     $user_id=$user->id;
    cart::create([
        'user_id'=>$user_id,
        'product_id'=>$product_id,
    ]); 
    return redirect()->back();
  }

  public function mycart(){
    if(Auth::id()){
      $user = Auth::user();
      $userid = $user->id;
      $count = cart::where('user_id',$userid)->count();
     $cart = cart::where('user_id',$userid)->get();

    }
    else{
      $count = 0;
    }
    return view('home.mycart',compact('count','cart'));
  }

  
  public function deletecart($id){
     cart::findOrFail($id)->delete();
     return redirect()->back();
  }
}
