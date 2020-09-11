<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Media;
use App\Models\Like;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('profile.index', compact('posts'));
    }

    public function create()
    {

        return view('profile.index');
    }

    public function store(PostRequest $request)
    {
        $post_request['user_id'] = Auth::id();
        $userId = Auth::id();
        $post_request['caption'] = $request->caption;
        $post = Post::create($post_request);

        if($request->hasFile('url'))
        {            
            foreach ($request->file('url') as $image)
            {
                $name = $image->getClientOriginalName();
                $image->move(public_path().config('media.image'), $name);
                $data[] = $name;
            };
            $media_request['post_id'] = $post->id; 
            $media_request['url'] = json_encode($data);
            $media = Media::create($media_request);
        }
    
        return redirect()->route('profile.index', compact('userId'));
    }

    public function edit($postId)
    {
        $post = Post::findOrFail($postId);
        $user = Auth::user();

        return view('post.editPost', compact('post', 'user'));
    }

    public function update($postId, Request $request)
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

        return redirect()->route('profile.index', compact('userId'));
    }

    public function show($post_id)
    {
        $post = Post::find($post_id);
        $comments = $post->comments;
        $countLike = Like::where([
            ['book_id', $post_id],
            ['status', config('constains.like')]
        ])->get();

        $countUnlike = Like::where([
            ['book_id', $post_id],
            ['status', config('constains.unlike')]
        ])->get();

        return view('profile.index', compact('post','comments', 'countLike', 'countUnlike'));
    }

    public function destroy($postId)
    {
        $post = Post::findOrFail($postId);
        $userId = Auth::id();
        $post->delete();

        return redirect()->route('profile.index', compact('userId'));
    }

    public function like($postId)
    {
        $check = Like::where([
            ['user_id', Auth::id()],
            ['post_id', $postId],
        ])->first();
        
        if ($check == null) 
        {
            $data = [
                'user_id' => Auth::id(),
                'post_id' => $postId,
                'status' => config('constains.like'),
            ];    

            Like::create($data);
        } 
        elseif ($check['status'] == config('const.like')) 
        {

            $check->delete();
        } 
        elseif ($check['status'] == config('const.unlike')) 
        {
            $check['status'] = config('const.like');

            $check->update();
        }

        return redirect()->route('', $postId);
    }

    public function unlike($postId)
    {
        $check = Like::where([
            ['user_id', Auth::id()],
            ['post_id', $postId],
        ])->first();
        
        if ($check == null) 
        {
            $data = [
                'user_id' => Auth::id(),
                'post_id' => $postId,
                'status' => config('constains.unlike'),
            ];    

            Like::create($data);
        } 
        elseif ($check['status'] == config('const.unlike')) 
        {

            $check->delete();
        } 
        elseif ($check['status'] == config('const.like')) 
        {
            $check['status'] = config('const.unlike');

            $check->update();
        }

        return redirect()->route('book_detail', $postId);
    }
}
