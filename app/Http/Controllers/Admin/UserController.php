<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getUsers()
    {
        $users = User::paginate(config('constains.paginate'));

        return view('admin.userList', compact('users'));
    }

    public function editUser($userId)
    {
        
        $user = User::findOrFail($userId);

        return view('admin.editUser', compact('user'));
    }

    public function updateUser($userId, Request $request)
    {
        $user = User::findOrFail($userId);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        if ($request->hasFile('avatar'))
        {            
            $fileName = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path().config('media.image'), $fileName);
            $user->avatar = $fileName;
        }
        
        $user->save();

        return back();
    }

    public function destroyUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect()->route('admin.users');
    }
}
