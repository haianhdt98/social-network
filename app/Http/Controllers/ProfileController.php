<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        $posts = Post::latest()->where('user_id', $user->id)->get();
        $followers = $user->followers;
        $following = $user->following;
        
        return view('profile.index',compact('user', 'posts', 'followers', 'following'));
    }

    public function followUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->followers()->attach(auth()->user()->id);

        return redirect()->back();
    }

    public function unFollowUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->followers()->detach(auth()->user()->id);

        return redirect()->back();
    }
    
    public function followers($userId)
    {
        $user = User::findOrFail($userId);
        $other = $user->followers;

        return view('profile.userList', compact('other', 'user'));
    }
    
    public function following($userId)
    {
        $user = User::findOrFail($userId);
        $other = $user->following;

        return view('profile.userList', compact('other', 'user'));
    }

    public function edit($userId)
    {
        $user = User::findOrFail($userId);
        
        return view('profile.edit',compact('user'));
    }

    public function update($userId, Request $request)
    {
        $user = User::findOrFail($userId);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        if($request->hasFile('avatar'))
        {            
            $fileName = $request->file('avatar')->getClientOriginalName();
            $request->file('avatar')->move(public_path().config('media.image'), $fileName);
            $user->avatar = $fileName;
        }
        
        $user->save();

        return redirect()->route('profile.edit', compact('userId'));
    }
}
