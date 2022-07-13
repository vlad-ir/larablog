<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPost;
use App\Models\Subscriber;


class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::select('posts.*', 'users.name as author')
            ->join('users', 'posts.author_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(6);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();
        $post->author_id = Auth::id();
        $post->title = $request->input('title');
        $post->intro = $request->input('intro');
        $post->text = $request->input('text');
        $this->uploadImage($request, $post);


        $subscribers = Subscriber::select('subscribers.email')->where('author_id', $post->author_id)->get();

        if (!$subscribers->isEmpty()) {
            foreach ($subscribers as $subscriber) {
                $data = ([
                    'postTitle' =>  $post->title,
                ]);
                Mail::to($subscriber->email)->send(new NewPost($data));
            }
        }
            $post->save();
            return redirect()->route('post.index')->with('success', 'New post created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::select('posts.*', 'users.name as author')
        ->join('users', 'posts.author_id', '=', 'users.id')
        ->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        if (!$this->checkRights($post)) {
            return redirect()->route('post.index')->withErrors('You can edit only your own posts');
        }
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        if (!$this->checkRights($post)) {
            return redirect()->route('post.index')->withErrors('You can edit only your own posts');
        }
        $post->title = $request->input('title');
        $post->intro = $request->input('intro');
        $post->text = $request->input('text');
        $this->uploadImage($request, $post);
        $post->update();
        return redirect()->route('post.show', compact('post'))->with('success', 'Post was edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (!$this->checkRights($post)) {
            return redirect()->route('post.index')->withErrors('You can delete only your own posts');
        }
        $post->delete();
        return redirect()->route('post.index')->with('success', 'Post was deleted!');
    }


    private function uploadImage(Request $request, Post $post) {

        $source = $request->file('image');

        if ($source || $request->input('remove')) {
            if (!empty($post->image)) {
                $name = basename($post->image);
                if (Storage::exists('public/image/source/' . $name)) {
                    Storage::delete('public/image/source/' . $name);
                }
                $post->image = null;
            }
        }

        if ($source) {
            $ext = str_replace('jpeg', 'jpg', $source->extension());
            $name = md5(uniqid());
            $path = Storage::putFileAs('public/image/source', $source, $name. '.' . $ext);
            $post->image = Storage::url($path);
        }
    }

    private function checkRights(Post $post) {
        return (Auth::id() == $post->author_id || Auth::id() == 1);
    }
}
