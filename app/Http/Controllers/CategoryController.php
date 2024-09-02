<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
        $data=category::all();
        return view('admin.category',compact('data'));
    }

    public function store(Request $request){
        $request->validate([
            'category_name'=>'required|max:255',
        ]);
       category::create([
        'category_name'=>$request->category_name,
        
    ]);

   // return redirect()->route('admin.category');
   return redirect()->back();
    }


  
    public function edit($id){
        $data=category::findOrFail($id);
        return view('admin.EditCategory',compact('data'));
     }

     public function update(Request $request,$id){
        $request->validate([
            'category_name'=>'required',
           
        ]);
        category::findOrFail($id)->update([
            'category_name'=>$request->category_name,
             
        ]);
        return redirect()->route('category.index');
     }


     

    public function destroy($id){
          category::findOrFail($id)->delete();
          return redirect()->back();
    }
}
