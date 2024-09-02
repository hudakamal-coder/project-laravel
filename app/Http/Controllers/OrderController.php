<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\User;
use App\Models\cart;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{



     public function index(){
        if(Auth::id()){
            $user = Auth::user();
            $userid = $user->id;
            $count = cart::where('user_id',$userid)->count();
          }
          else{
            $count = 0;
          }
        return view('home.order',compact('count'));
     }





     public function store(Request $request) {
        $user = Auth::user();
        $userid = $user->id;
        $cartItems = cart::where('user_id', $userid)->get();
        foreach ($cartItems as $cartItem) {
            $cartItem->product_id;
        $order = order::create([
            'user_id' => $userid,
            'name' => $request->input('name'),
            'adress' => $request->input('adress'),
            'phone' => $request->input('phone'),
            'product_id'=>$cartItem->product_id,
            
        ]);  
        cart::where('user_id', $userid)->delete(); 
    }
        return redirect()->back();    
}
}