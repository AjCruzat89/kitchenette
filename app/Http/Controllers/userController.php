<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Cart;
use App\Models\Order;
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
                ->select('products.id', 'products.product_name', 'products.product_picture', 'products.product_price', 'products.product_stock', 'cart.quantity')
                ->orderBy('products.created_at', 'asc')
                ->get();


            foreach ($products as $product) {
                $product->product_pictureURL = asset('storage/' . $product->product_picture);
            }
            return view('page.menu', ['products' => $products]);
        }

        $products = Product::orderBy('created_at', 'desc')->get();

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
                return response()->json(['error' => 'Remaining Stock Is: ' . $product->product_stock]);
            }

            $productExists = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

            if ($productExists) {
                if($productExists->quantity + $requestedQuantity > $product->product_stock){
                    return response()->json(['error' => 'No More Available Stock!']);
                }
                elseif($product->product_stock == 0){
                    return response()->json(['error' => 'No More Available Stock!']);
                }
                $productExists->quantity += $requestedQuantity;
                $productExists->save();
                return response()->json(['success' => 'Successfully Updated The Quantity Of Product!']);
            } else {
                $cart = new Cart();
                $cart->user_id = $user->id;
                $cart->product_id = $productId;
                $cart->quantity = $requestedQuantity;
                $cart->save();
                return response()->json(['success' => 'Successfully Added To Cart!']);
            }
        } else {
            return response()->json(['error' => 'User not authenticated.']);
        }
    }
    //<!--===============================================================================================-->
    public function cartPage(Request $req)
    {
        $carts = Cart::select('cart.product_id', 'products.product_name', 'products.product_picture', 'products.product_price', 'cart.quantity')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->join('users', 'cart.user_id', '=', 'users.id')
            ->where('cart.user_id', '=', auth()->user()->id)
            ->orderBy('products.product_name', 'asc')
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
            ->orderBy('products.product_name', 'asc')
            ->get();

        foreach ($items as $item) {
            $item->product_pictureURL = asset('storage/' . $item->product_picture);
            $item->total = $item->product_price * $item->quantity;
        }

        $itemsGrandTotal = $items->sum('total');
        return view('page.checkout', ['items' => $items, 'itemsGrandTotal' => $itemsGrandTotal]);
    }
    //<!--===============================================================================================-->
    public function placeOrder(Request $req)
    {
        $ordersArray = implode(", ", $req->input('orders'));
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->phone_number = $req->input('phone_number');
        $order->email = auth()->user()->email;
        $order->address = $req->input('address');
        $order->orders = $ordersArray;
        $order->grand_total = $req->input('grandTotal');
        $order->payment_method = $req->input('payment_method');
        $order->save();

        $updateProducts = Product::whereIn('id', $req->product_id)
            ->orderBy('product_name', 'asc')
            ->get();

        foreach ($updateProducts as $key => $product) {
            $quantity = $req->input('quantity')[$key];
            $product->product_stock -= $quantity;
            $product->save();
        }

        $updateCarts = Cart::select('cart.product_id', 'products.product_name', 'products.product_picture', 'products.product_price', 'cart.quantity')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->join('users', 'cart.user_id', '=', 'users.id')
            ->where('cart.user_id', '=', auth()->user()->id)
            ->orderBy('products.product_name', 'asc')
            ->get();

        foreach ($updateCarts as $key => $cart) {
            $quantity = $req->input('quantity')[$key];
            Cart::where('product_id', $cart->product_id)->decrement('quantity', $quantity);
        }

        $emptyCarts = Cart::where('quantity', '<=', 0)
            ->where('user_id', auth()->user()->id)
            ->delete();

        return redirect()->route('cart')->with('success', 'Placed Order Successfully!');
    }
    //<!--===============================================================================================-->
    public function orderStatusPage(Request $req)
    {

        $orders = Order::where('user_id', auth()->user()->id)->get();

        return view('page.orderstatus', ['orders' => $orders]);
    }
    //<!--===============================================================================================-->
}
