<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function activityLog()
    {
        $activityLogs = Activity::orderBy('created_at', 'desc')->paginate(10);
        return view('page.activity', ['activityLogs' => $activityLogs]); 
    }
}

