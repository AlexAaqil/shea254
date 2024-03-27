<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function index()
    {
        $user_level = Auth()->user()->user_level;
        
        if($user_level == 2)
        {
            return redirect()->route('dashboard');
        }
        else if($user_level == 1)
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function admin_dashboard()
    {
        $count_admins = User::getAdmins()->count();
        $count_users = User::getUsers()->count();
        $count_blogs = Blog::count();
        $count_comments = Comment::count();

        return view('admin.dashboard', compact(
            'count_admins',
            'count_users',
            'count_blogs',
            'count_comments',
        ));
    }
}
