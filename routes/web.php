<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\cart;
use App\Models\category;
use App\Models\product;
use App\Models\order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'home'])->name('home');

Route::get('detail/{id}', [HomeController::class,'detail'])->name('detail');

Route::get('addcart/{id}', [HomeController::class,'addcart'])->middleware(['auth', 'verified'])->name('addcart');

Route::get('mycart',[HomeController::class,'mycart'])->name('mycart')->middleware(['auth', 'verified']);

Route::post('deletecart/{id}',[HomeController::class,'deletecart'])->name('deletecart')->middleware(['auth', 'verified']);

Route::get('admin',[AdminController::class,'index'])->middleware('auth','admin')->name('admin');
 
Route::resource('/category',CategoryController::class);

Route::resource('/product',ProductController::class);

Route::get('viewproduct',[ProductController::class,'view'])->name('view');

Route::get('search',[ProductController::class,'search'])->name('search');

Route::resource('order',OrderController::class)->middleware(['auth', 'verified']);     

Route::get('vieworder',[AdminController::class,'vieworder'])->name('vieworder')->middleware('auth','admin');
                                                                                                                                                                                                                          
Route::get('ontheway/{id}',[AdminController::class,'ontheway'])->name('ontheway')->middleware('auth','admin');

Route::get('delivery/{id}',[AdminController::class,'delivery'])->name('delivery')->middleware('auth','admin');










Route::get('/dashboard', function () {
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

 

require __DIR__.'/auth.php';
