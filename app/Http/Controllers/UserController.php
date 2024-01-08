<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list_admins()
    {
        $list_admins = user::getAdmins();
        return view ('admin.list_admins', compact('list_admins'));
    }

    public function get_update_admin($id)
    {
        $admin = User::find($id);
        return view('admin.update_admin', compact('admin'));
    }


    public function post_update_admin($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $admin = User::find($id);
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->email = $request->email;
        $admin->phone_number = $request->phone_number;
        $admin->user_level = $request->user_level;
        $admin->status = $request->status;
        if(!empty($request->password)){
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->route('list_admins')->with('success',"Admin updated Successfully");
    }

    public function list_users()
    {
        $list_users = user::getUsers();
        return view('admin.list_users', compact('list_users'));
    }

    public function get_update_user($id)
    {
        $admin = User::find($id);
        return view('admin.update_user', compact('admin'));
    }

    public function post_update_user($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user = user::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->user_level = $request->user_level;
        $user->status = $request->status;
        if(!empty($request->password)){
            $admin->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('list_users')->with('success',"User updated successfully");


    }
}
