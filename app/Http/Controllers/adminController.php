<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    //<!--===============================================================================================-->
    public function adminPage()
    {
        $userCount = User::where('user_role', '!=', 'admin')->count();
        return view('page.admin', ['userCount' => $userCount]);
    }
    //<!--===============================================================================================-->
    public function activityPage()
    {
        $activityLogs = Activity::orderBy('created_at', 'desc')->paginate(10);
        return view('page.activity', ['activityLogs' => $activityLogs]);
    }
    //<!--===============================================================================================-->
    public function addProduct(Request $req)
    {
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
    public function productPage()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);
        foreach ($products as $product) {
            $product->product_pictureURL = asset('storage/' . $product->product_picture);
        }
        return view('page.product', ['products' => $products]);
    }
    //<!--===============================================================================================-->
    public function editProduct(Request $req)
    {
        $req->validate([
            'product_id' => 'required|numeric',
            'product_name' => 'required',
            'product_picture' => 'image|max:5120',
            'product_price' => 'required|numeric',
            'product_stock' => 'required|numeric'
        ]);

        $product = Product::where('id', $req->product_id)->first();

        $user = Auth::user();
        $activity = new Activity();
        $activity->name = $user->name;
        $activity->activity = 'User: ' . $user->name . ' modified the product ' . $product->product_name . ' at ' . Carbon::now();
        $activity->save();

        
        $product->product_name = $req->product_name;
        if ($req->hasFile('product_picture')) {
            $previousPath = 'public/' . $product->product_picture;
            Storage::delete($previousPath);
            $imagePath = $req->file('product_picture')->store('products', 'public');
            $product->product_picture = $imagePath;
        }
        $product->product_price = $req->product_price;
        $product->product_stock = $req->product_stock;
        $product->save();

        return redirect()->route('product')->with('success', 'Product Edited Successfully!');
    }
    //<!--===============================================================================================-->
    public function deleteProduct(Request $req)
    {
        $req->validate([
            'product_id' => 'required'
        ]);

        $product =  Product::where('id', $req->product_id)->first();

        if ($product) {
            $imagePath = 'public/' . $product->product_picture;
            Storage::delete($imagePath);
            $user = Auth::user();
            $activity = new Activity();
            $activity->name = $user->name;
            $activity->activity = 'User: ' . $user->name . ' deleted the product ' . $product->product_name . ' at ' . Carbon::now();
            $activity->save();
            $product->delete();
            return redirect()->route('product')->with('success', 'Product Deleted Successfully!');
        } else {
            return redirect()->route('product')->with('error', 'Product Not Found!');
        }
    }
    //<!--===============================================================================================-->
}
