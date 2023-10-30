<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function adminPage(){
        $userCount = User::where('user_role' , '!=', 'admin' )->count();
        return view('page.admin', ['userCount' => $userCount]);
    }

    public function activityPage()
    {
        $activityLogs = Activity::orderBy('created_at', 'desc')->paginate(10);
        return view('page.activity', ['activityLogs' => $activityLogs]); 
    }

    public function addProduct(Request $req){
        $req->validate([
            'product_name' => 'required',
            'product_picture' => 'required',
            'product_price' => 'required|numeric',
            'product_stocks' => 'required|numeric',
        ]);

        return redirect()->route('product')->with('success', 'Hi');
    }
}

