<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Comment;
use App\Like;

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->take(15)->get();
        $posts_count = Post::select('id')->take(16)->get();
        $likes = Like::where('user_id', '=', auth()->user()->id)->get();
        $check = 0;
        return view('home')->with(['posts' => $posts, 'likes' => $likes, 'check' => $check, 'posts_count' => $posts_count]);
    }


    /**
     * Display a listing of the resource.
     *
     * @param  int  $count
     * @return \Illuminate\Http\Response
     */
    public function index2($count)
    {
        $posts = Post::orderBy('created_at', 'desc')->skip($count)->take(15)->get();
        $likes = Like::where('user_id', '=', auth()->user()->id)->get();
        $check = 0;
        if(count($posts) > 0) {
            return view('inc.post')->with(['posts' => $posts, 'likes' => $likes, 'check' => $check]);
        } else {
            return NULL;
        }
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
            'body' => 'required',
            'post_img' => 'image|nullable|max:10200'
        ]);

        // Handle file upload
        if($request->hasFile('post_img')){
            // Get filename with extension
            $fileNameWithExt = $request->file('post_img')->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just text
            $extension = $request->file('post_img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('post_img')->storeAs('public/images', $fileNameToStore);
        } 

        // Creat Post
        $post = new Post;
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->likes_num = 0;
        $post->comments_num = 0;
        if($request->hasFile('post_img')){
            $post->post_img = $fileNameToStore;
        }
        $post->save();

        return redirect('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Display the Post with Comments
        $post = Post::find($id);
        $comments = Comment::orderBy('created_at', 'desc')->where('post_id', $id)->take(15)->get();
        $likes = Like::where('user_id', '=', auth()->user()->id)->get();
        $check = 0;
        return view('post')->with(['comments' => $comments, 'post' => $post, 'likes' => $likes, 'check' => $check]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $count
     * @return \Illuminate\Http\Response
     */
    public function show2($id, $count)
    {
        // Display the Post with Comments
        $post = Post::find($id);
        $comments = Comment::orderBy('created_at', 'desc')->where('post_id', $id)->skip($count)->take(15)->get();
        $likes = Like::where('user_id', '=', auth()->user()->id)->get();
        $check = 0;
        return view('post')->with(['comments' => $comments, 'post' => $post, 'likes' => $likes, 'check' => $check]);
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
            'body' => 'required',
            'post_img' => 'image|nullable|max:10200'
        ]);

        // Handle file upload
        if($request->hasFile('post_img')){
            // Get filename with extension
            $fileNameWithExt = $request->file('post_img')->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just text
            $extension = $request->file('post_img')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('post_img')->storeAs('public/images', $fileNameToStore);
        } 

        // Edit Post
        $post = Post::find($id);
        $post->body = $request->input('body');
        if($request->file('post_img')){
            $post->post_img = $fileNameToStore;
        }
        if($post->user_id == auth()->user()->id){
            $post->save();
        }

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = POST::find($id);
        $comments = Comment::where('post_id', '=', $id)->get();
        $likes = Like::where('post_id', '=', $id)->get();
        if($post->user_id == auth()->user()->id){
            $post->delete();
            foreach($comments as $comment){
                $comment->delete();
            }
            foreach($likes as $like){
                $like->delete();
            }
            if($post->post_img){
                Storage::delete('/public/images/' . $post->post_img);
            }
        }
        return redirect('/home');
    }
}
