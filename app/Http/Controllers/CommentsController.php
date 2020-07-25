<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;
use App\Notifications\NewComment;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $this->validate($request, [
            'body' => 'required'
        ]);
        // Create Comment
        $comment = New Comment;
        $comment->body = $request->input('body');
        $comment->post_id = $request->input('post-id');
        $comment->user_id = auth()->user()->id;
        $comment->save();
        
        $post = Post::find($request->input('post-id'));
        $post->comments_num = $post->comments_num + 1;
        $post->save();

        // Sending Notification
        if($post->user_id != auth()->user()->id){
            $user_id = $post->user_id;
            $user = User::find($user_id);
            $commenter = User::find(auth()->user()->id);
            $user->notify(new NewComment($commenter, $post));
        }

        return redirect('/posts/' . $request->input('post-id'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Update Comment
        $comment = Comment::find($id);
        $comment->body = $request->input('body');
        $comment->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post = Post::find($comment->post_id);
        // Check User
        if($comment->user_id == auth()->user()->id){
            $comment->delete();
            $post->comments_num = $post->comments_num - 1;
            $post->save();
        }

        return back();
    }
}
