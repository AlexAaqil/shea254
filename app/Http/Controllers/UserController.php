<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function list_admins()
    {
        $list_admins = user::getAdmins();
        return view ('admin.users.admins', compact('list_admins'));
    }

    public function get_update_admin($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.update_admin', compact('admin'));
    }


    public function post_update_admin($id, Request $request)
    {
        $admin = User::findOrFail($id);
        $admin->user_level = $request->user_level;
        $admin->status = $request->status;

        $admin->save();

        return redirect()->route('list_admins')->with('success', [
            'message' => "Admin updated Successfully",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function list_users()
    {
        $list_users = user::getUsers();
        return view('admin.users.users', compact('list_users'));
    }

    public function get_update_user($id)
    {
        $user = User::find($id);
        return view('admin.update_user', compact('user'));
    }

    public function post_update_user($id, Request $request)
    {
        $user = User::findOrFail($id);

        $user->user_level = $request->user_level;
        $user->status = $request->status;

        $user->save();

        return redirect()->route('list_users')->with('success', [
            'message' => "User updated successfully",
            'duration' => $this->alert_message_duration,
        ]);
    }
}
