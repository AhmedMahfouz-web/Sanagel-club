<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Like;

class ProfileController extends Controller
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $posts = Post::orderBy('created_at', 'desc')->where('user_id', $user_id)->take(15)->get();
        $user = User::find($user_id);
        $likes = Like::where('user_id', '=', auth()->user()->id)->get();
        $check = 0;
        return view('profile')->with(['user' => $user, 'posts' => $posts, 'likes' => $likes, 'check' => $check]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $count
     * @return \Illuminate\Http\Response
     */
    public function index2($count)
    {
        $user_id = auth()->user()->id;
        $posts = Post::orderBy('created_at', 'desc')->where('user_id', $user_id)->skip($count)->take(15)->get();
        $likes = Like::where('user_id', '=', auth()->user()->id)->get();
        $check = 0;
        return view('inc.post')->with(['posts' => $posts, 'likes' => $likes, 'check' => $check]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::orderBy('created_at', 'desc')->where('user_id', $id)->take(15)->get();
        $user = User::find($id);
        $likes = Like::where('user_id', '=', auth()->user()->id)->get();
        $check = 0;
        return view('profile')->with(['user' => $user, 'posts' => $posts, 'likes' => $likes, 'check' => $check]);
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
        $posts = Post::orderBy('created_at', 'desc')->where('user_id', $id)->skip($count)->take(15)->get();
        $likes = Like::where('user_id', '=', auth()->user()->id)->get();
        $check = 0;
        return view('inc.post')->with(['posts' => $posts, 'likes' => $likes, 'check' => $check]);
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
            'profile_picture' => 'image|nullable|max:10200'
        ]);

        // Handle file upload
        if($request->hasFile('profile_picture')){
            // Get filename with extension
            $fileNameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Get just text
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('profile_picture')->storeAs('public/images', $fileNameToStore);
        }

        $user = User::find($id);
        $user->bio = $request->bio;
        if($request->hasFile('profile_picture')){
            $user->profile_pic = $fileNameToStore;
        }
        $user->save();

        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
