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
        $products = Product::where('product_stock', '!=', '0')
            ->orderBy('created_at', 'desc')
            ->get();
        foreach ($products as $product) {
            $product->product_pictureURL = asset('storage/' . $product->product_picture);
        }

        return view('page.home', ['products' => $products]);
    }
    //<!--===============================================================================================-->
    public function menuPage(Request $req)
    {
        if ($user = Auth::user()) {
            $products = Product::leftJoin('cart', function ($join) {
                $join->on('products.id', '=', 'cart.product_id')
                    ->where('cart.user_id', '=', auth()->user()->id);
            })
                ->whereRaw('products.product_stock > IFNULL(cart.quantity, 0)')
                ->select('products.id', 'products.product_name', 'products.product_picture', 'products.product_price')
                ->orderBy('products.created_at', 'desc')
                ->get();


            foreach ($products as $product) {
                $product->product_pictureURL = asset('storage/' . $product->product_picture);
            }
            return view('page.menu', ['products' => $products]);
        }

        $products = Product::where('product_stock', '!=', '0')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($products as $product) {
            $product->product_pictureURL = asset('storage/' . $product->product_picture);
        }

        return view('page.menu', ['products' => $products]);
    }
    //<!--===============================================================================================-->
    public function addToCart(Request $req)
    {
        $productId = $req->input('product_id');
        $requestedQuantity = $req->input('quantity');

        $product = Product::where('id', $productId)->first();

        if ($user = Auth::user()) {

            if ($requestedQuantity > $product->product_stock) {
                return back()->with('error', 'Remaining Stock Is: ' . $product->product_stock);
            }

            $productExists = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

            if ($productExists) {
                $productExists->quantity += $requestedQuantity;
                $productExists->save();
                return back()->with('success', 'Successfully Updated The Quantity Of Product!');
            } else {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $productId;
                $cart->quantity = $requestedQuantity;
                $cart->save();
                return back()->with('success', 'Successfully Added To Cart!');
            }
        } else {
            return redirect()->route('loginPage');
        }
    }
    //<!--===============================================================================================-->
    public function cartPage(Request $req)
    {
        $carts = Cart::select('cart.product_id', 'products.product_name', 'products.product_picture', 'products.product_price', 'cart.quantity')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->join('users', 'cart.user_id', '=', 'users.id')
            ->where('cart.user_id', '=', auth()->user()->id)
            ->get();

        foreach ($carts as $cart) {
            $cart->product_pictureURL = asset('storage/' . $cart->product_picture);
            $cart->total = $cart->product_price * $cart->quantity;
        }
        return view('page.cart', ['carts' => $carts]);
    }
    //<!--===============================================================================================-->
    public function checkout(Request $req)
    {

        $items = Cart::select('cart.product_id', 'products.product_name', 'products.product_picture', 'products.product_price', 'cart.quantity')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->join('users', 'cart.user_id', '=', 'users.id')
            ->where('cart.user_id', '=', auth()->user()->id)
            ->whereIn('cart.product_id', $req->input('checkbox'))
            ->get();

            foreach ($items as $item) {
                $item->product_pictureURL = asset('storage/' . $item->product_picture);
                $item->total = $item->product_price * $item->quantity;
            }

        return view('page.checkout', ['items' => $items]);
    }
    //<!--===============================================================================================-->
}
