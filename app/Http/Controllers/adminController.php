<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class adminController extends Controller
{   
    //<!--===============================================================================================-->
    public function adminPage(){
        $userCount = User::where('user_role' , '!=', 'admin' )->count();
        return view('page.admin', ['userCount' => $userCount]);
    }
    //<!--===============================================================================================-->
    public function activityPage()
    {
        $activityLogs = Activity::orderBy('created_at', 'desc')->paginate(10);
        return view('page.activity', ['activityLogs' => $activityLogs]); 
    }
    //<!--===============================================================================================-->
    public function addProduct(Request $req){
        $req->validate([
            'product_name' => 'required|unique:products',
            'product_picture' => 'required|image|max:5120',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric',
        ]);
    
        $product = new Product;
        $product->product_name = $req->product_name;
        if ($req->hasFile('product_picture')) {
            $imagePath = $req->file('product_picture')->store('products', 'public');
            $product->product_picture = $imagePath;
        }
        $product->product_price = $req->product_price;
        $product->product_stock = $req->product_stock;
        $product->save();

        $user = Auth::user();
        $activity = new Activity();
        $activity->name = $user->name;
        $activity->activity = 'User: ' . $user->name . ' added the product ' . $product->product_name . ' at ' . Carbon::now();
        $activity->save();
        return redirect()->route('product')->with('success', 'Product added successfully.');
    }
    //<!--===============================================================================================-->
    public function productPage(){
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        foreach($products as $product){
            $product->product_pictureURL = asset('storage/' . $product->product_picture);
        }
        return view('page.product', ['products' => $products]);
    }
    //<!--===============================================================================================-->
}

