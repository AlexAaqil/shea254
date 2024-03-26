<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function admins()
    {
        $admins = User::getAdmins();
        return view('admins.index', compact('admins'));
    }
}
