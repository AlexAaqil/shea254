<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $user_level = Auth()->user()->user_level;

            if($user_level==2)
            {
                return view('dashboard');
            }
            else if($user_level==1)
            {
                return view('admin.dashboard');
            }
            else
            {
                return redirect()->back();
            }
        }
    }
}
