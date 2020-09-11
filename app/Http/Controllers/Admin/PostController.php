<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getPosts()
    {
        $posts = Post::paginate(config('constains.paginate'));

        return view('admin.postList', compact('posts'));
    }

    public function editPost($postId)
    {
        
        $post = Post::findOrFail($postId);
        $user = $post->user;

        return view('admin.editPost', compact('post', 'user'));
    }

    public function updatePost($postId, Request $request)
    {
        $post = Post::findOrFail($postId);
        $userId = Auth::id();

        $post->caption = $request->caption;
        $media = Media::where('post_id', $postId)->delete();

        if ($request->hasFile('url'))
        {            
            foreach ($request->file('url') as $image)
            {
                $name = $image->getClientOriginalName();
                $image->move(public_path().config('media.image'), $name);
                $data[] = $name;
            };
            $media_request['post_id'] = $post->id;
            $media_request['url'] = json_encode($data);
            $media = Media::updateOrCreate($media_request);
        }

        $post->save();

        return back();
    }

    public function destroyPost($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();

        return redirect()->route('admin.posts');
    }
}
