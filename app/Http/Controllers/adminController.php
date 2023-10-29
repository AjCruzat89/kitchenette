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


    public function activityLog()
    {
        $activityLogs = Activity::orderBy('created_at', 'desc')->paginate(10);
        return view('page.activity', ['activityLogs' => $activityLogs]); 
    }
}

