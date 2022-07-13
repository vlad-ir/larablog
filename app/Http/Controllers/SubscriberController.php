<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\SubscribeRequest;

class SubscriberController extends Controller
{
    public function store(SubscribeRequest $request, $id)
    {
        $post = Post::findOrFail($id);    
        $subscriber = new Subscriber();
        $subscriber->author_id = $post->author_id;
        $subscriber->email = $request->input('email');
        $subscriber->save();
        return redirect()->route('post.show', compact('post'))->with('success', 'You are subscribed for author posts!');

    }
}
