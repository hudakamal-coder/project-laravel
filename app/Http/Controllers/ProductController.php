<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;

class ProductController extends Controller
{
    public function index(){
        $data=product::all();
        $category=category::all();
        return view('admin.addproduct',compact('data','category'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'title' => ['required', 'max:255'],
          'description' => 'required', 
            'image' => 'required|file|image|mimes:png,jpg,jpeg',
           'price' => 'required|numeric', 
            'category' => 'required', 
            'quantity' => 'required|numeric'
        ]);
    
       if ($request->hasFile('image')) {
           $path = $request->file('image')->store('photos','public');
            $validatedData['image'] = basename($path);   
       }
        // Create the product with validated data
        Product::create($validatedData);
        // Redirect back with a success message
     //   return redirect()->route('products.index')->with('success', 'Product created successfully.');
     return redirect()->back();
    }
    


public function destroy($id){
    product::findOrFail($id)->delete();
    return back()->with('success','send data');
}


public function edit($id){
    $data=product::find($id);
    $category=category::all();
    return view('admin.EditProduct',compact('data','category'));

}

public function update(Request $request,$id){
    $validatedData = $request->validate([
        'title' => ['required', 'max:255'],
       'description' => 'required', 
         'image' => 'required|file|image|mimes:png,jpg,jpeg',
        'price' => 'required|numeric', 
         'category' => 'required', 
         'quantity' => 'required|numeric'
     ]);
     if ($request->hasFile('image')) {
        $path = $request->file('image')->store('photos','public');
         $validatedData['image'] = basename($path);   
    }
     Product::findOrFail($id)->update($validatedData);

     return redirect()->back();
}

 public function view(){
    $data=product::all();
    $category=category::all();
    return view('admin.viewproduct',compact('data','category'));
 }


public function search(Request $request){
$search = $request->search;
$data = product::where('title','LIKE','%'.$search.'%')->get();
 return view('admin.viewproduct',compact('data'));
}



}
