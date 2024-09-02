<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }
    public function vieworder(){
       $order = order::all();
        return view('admin.vieworder',compact('order'));
    }

    public function ontheway($id){
         $order = order::find($id);
          $order->status = 'on the way' ;
            $order->save();
          return redirect('vieworder');
    }

    public function delivery($id){
          $order = order::find($id);
          $order->status = 'delivery';
            $order->save();
          return redirect('vieworder');
    }
}
