<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\Post;
use App\User;
use App\Notifications\NewLike;

class LikesController extends Controller
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
        // Checking if the like exists
        if(Like::where('user_id', '=', auth()->user()->id)->where('post_id', '=', $request->input('post-id'))->count() > 0 ){
            return 'Hello';

        }else{
            // New Like
            $like = New Like;
            $like->post_id = $request->input('post-id');
            $like->user_id = auth()->user()->id;
            $like->save();

            $post = Post::find($request->input('post-id'));
            $post->likes_num = $post->likes_num + 1;
            $post->save();


            // Sending Notification
            if($post->user_id != auth()->user()->id){
                $user_id = $post->user_id;
                $user = User::find($user_id);
                $liker = User::find(auth()->user()->id);
                $user->notify(new NewLike($liker, $post));
            }
            
            $likes = Like::where('user_id', '=', auth()->user()->id)->get();
            $check = 0;

            // return view('inc.postAction')->with(['post' => $post, 'likes' => $likes, 'check' => $check]);
            return response()->json([
                'likes' => $post->likes_num,
                'comments' => $post->comments_num,
            ]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Checking if the like doesn't exist
        if(Like::where('user_id', '=', auth()->user()->id)->where('post_id', '=', $id)->count() < 1 ){
            return 'Hello2';

        }else{
            // Deleting like
            $like_id = Like::where('user_id', '=', auth()->user()->id)->where('post_id', '=', $id)->first();
            $like = Like::find($like_id->id);
            if($like->user_id == auth()->user()->id){
                $like->delete();
                
                $post = Post::find($id);
                $post->likes_num = $post->likes_num - 1;
                $post->save();
            }
            $likes = Like::where('user_id', '=', auth()->user()->id)->get();
            $check = 0;
            
            // return view('inc.postAction')->with(['post' => $post, 'likes' => $likes, 'check' => $check]);
        
            return response()->json([
                'likes' => $post->likes_num,
                'comments' => $post->comments_num,
            ]);
        }
    }
}
