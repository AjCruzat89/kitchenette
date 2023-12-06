<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class userController extends Controller
{
    //<!--===============================================================================================-->
    public function homePage(Request $req)
    {
        $products = Product::where('product_stock', '!=', '0')->get();
        foreach ($products as $product) {
            $product->product_pictureURL = asset('storage/' . $product->product_picture);
        }

        return view('page.home', ['products' => $products]);
    }
    //<!--===============================================================================================-->
    public function menuPage(Request $req)
    {
        $products = Product::where('product_stock', '!=', '0')->get();
        foreach ($products as $product) {
            $product->product_pictureURL = asset('storage/' . $product->product_picture);
        }

        return view('page.menu', ['products' => $products]);
    }
    //<!--===============================================================================================-->
    public function addToCart(Request $req)
    {
        if ($user = Auth::user()) {
            $productExists = Cart::where('user_id', $user->id)->where('product_id', $req->input('product_id'))->first();

            if ($productExists) {
                $productExists->quantity += $req->input('quantity');
                $productExists->save();
                return back()->with('success', 'Successfully Updated The Quantity Of Product!');
            } else {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $req->input('product_id');
                $cart->quantity = $req->input('quantity');
                $cart->save();
                return back()->with('success', 'Successfully Added To Cart!');
            }
        } else {
            return redirect()->route('loginPage');
        }
    }
    //<!--===============================================================================================-->
}
