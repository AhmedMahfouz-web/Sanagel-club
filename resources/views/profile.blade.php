@extends('layouts.app')

@section('css-page')
    <link href="{{ asset('css/profile-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">    
@endsection

@section('content')
<main>
    <div class="profile-info">
        @if(Auth::user()->id == $user->id)
            <button class="edit-profile" onclick="edit_profile()">
                <i class="fas fa-user-edit"></i>
                <p>Edit</p>
            </button>
        @endif
        <div class="view">
            <img src="/storage/images/{{$user->profile_pic}}" title="{{$user->fname}} {{$user->lname}}">
            <h2>{{$user->fname}} {{$user->lname}}</h2>
            <div class="bio">
                <h4>Bio</h4>
                <p>{{$user->bio}}</p>
            </div>
        </div>
        {!! Form::open(['action' => ['ProfileController@update', $user->id], 'method' => 'POST', 'id' => 'edit-form', 'enctype' => "multipart/form-data"]) !!}
            <img src="/storage/images/{{$user->profile_pic}}">
            <input type="file" name="profile_picture" id="" form="edit-form">
            <div class="bio">
                <h4>Bio</h4>
                {!! Form::textarea('bio', $user->bio, ['placeholder' => "Tell us about yourself ♥"]) !!}
            </div>
            <div class="action-btn">
                <button class="ebss" form="edit-form">Save</button>
                <button class="ebcc" type="button" onclick="cancel_edit_profile()">Cancel</button>
            </div>
            {!! Form::hidden('_method', 'PUT')!!}
            <section class="fix"></section>
        {!! Form::close() !!}
    </div>
        
    <div class="container">
        @if(count($posts) > 0)
        <div class="post-container">
            @foreach($posts as $post)
                    <div class="post">
                        <div class="post-head">
                            <a>
                                <img src="/storage/images/{{$user->profile_pic}}" title="{{$post->user->fname}} {{$post->user->lname}}">
                                <div class="head-details">
                                    <h3>{{$post->user->fname}} {{$post->user->lname}}</h3>
                                    <p class="date">{{$post->created_at}}</p>
                                </div>
                            </a>
                            @if(Auth::user()->id == $post->user_id)
                                <div class="head-button">
                                    <button class="more"><i class="fas fa-ellipsis-h"></i></button>
                                    <div class="optiones">
                                        <button class="edit-btn"><i class="fas fa-pencil-alt"></i> Edit</button>
                                        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'id' => 'detele-form']) !!}
                                            <button type="submit" form="detele-form" class="delete-btn"><i class="fas fa-trash-alt"></i> Delete</button>
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            @else
                                <div class="head-button" style="display: none;">
                                    <button class="more"><i class="fas fa-ellipsis-h"></i></button>
                                    <div class="optiones">
                                        <button class="edit-btn"><i class="fas fa-pencil-alt"></i> Edit</button>
                                        {!! Form::open(['id' => 'detele-form']) !!}
                                            <button type="submit" class="delete-btn"><i class="fas fa-trash-alt"></i> Delete</button>
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                        <section class="fix"></section>
                        <div class="post-details">
                            <div class="content">
                                <p>{{$post->body}}</p>
                            </div>
                            {!! Form::open(['action' => ['PostsController@update', $post->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'edit-form', 'id' => 'edit-form']) !!}
                                {!! Form::textarea('body', $post->body, ['cols' => '30', 'rows' => '10', 'placeholder' => "What's in your mind ?..."]) !!}
                                <h4>Change image :</h4>{!! Form::file('post_img') !!}
                                {!! Form::hidden('_method', 'PUT')!!}
                            {!! Form::close() !!}
                        </div>
                        
                        @if($post->post_img)
                            <div class="post-img">
                                <img src="/storage/images/{!! $post->post_img !!}" alt="Post's img">
                            </div>
                        @endif
                        <div class="post-action">
                            <div class="left-action">
                                
                                @if(count($likes) > 0)
                                    <input type="hidden" value={!! $check = 0 !!}>
                                    @foreach($likes as $like) 
                                        @if($like->post_id == $post->id)
                                        <input type="hidden" value={!! $check++ !!}>
                                        @endif
                                    @endforeach
    
                                    @if($check > 0)
                                    {!! Form::open(['action' => ['LikesController@destroy', $post->id], 'method' => 'POST', 'id' => 'delete-like-form'.$post->id, 'style' => 'display: inline-block;', 'class' => 'like-form']) !!}
                                        <button  type="submit" class="love-btn">
                                            <i class='love fas fa-heart'></i>
                                            <p class="plove">Loved</p>
                                        </button>
                                        {!! Form::hidden('post-id', $post->id, ['class' => 'post-id'])!!}
                                        {!! Form::hidden('_method', 'DELETE',['class' => '_method' . $post->id]) !!}
                                    {!! Form::close() !!}
    
                                    @else
                                    {!! Form::open(['action' => 'LikesController@store', 'method' => 'POST', 'id' => 'like-form'.$post->id, 'style' => 'display: inline-block;', 'class' => 'like-form']) !!}
                                        {!! Form::hidden('post-id', $post->id, ['class' => 'post-id'])!!}
                                        <button type="submit" class="love-btn">
                                            <i class='love far fa-heart'></i>
                                            <p class="plove">Love</p>
                                        </button>
                                    {!! Form::close() !!}
    
                                    @endif
    
                                @else
                                {!! Form::open(['action' => 'LikesController@store', 'method' => 'POST', 'id' => 'like-form'.$post->id, 'style' => 'display: inline-block;', 'class' => 'like-form']) !!}
                                    {!! Form::hidden('post-id', $post->id, ['class' => 'post-id'])!!}
                                    <button type="submit" class="love-btn">
                                        <i class='love far fa-heart'></i>
                                        <p class="plove">Love</p>
                                    </button>
                                {!! Form::close() !!}
                                @endif
                                <button class="comment">
                                    <i class="fas fa-comment"></i>
                                    <p>Commment</p>
                                </button>
                            </div>
                            <div class="right-action">
                                <a href="/posts/{{ $post->id }}"><p class="likes">{{ $post->likes_num }}
                                    @if($post->likes_num > 1)
                                        Likes
                                    @else
                                        Like
                                    @endif
                                    </p>
                                </a>
                                <a href="/posts/{{ $post->id }}"><p class="comments">{{ $post->comments_num }}
                                    @if($post->comments_num > 1)
                                        Comments
                                    @else
                                        Comment
                                    @endif
                                    </p>
                                </a>
                                {!! Form::submit('Save', ['class' => 'ebs', 'form' => 'edit-form' . $post->id]) !!}
                                <button class="ebc" type="button">Cancel</button>
                            </div>
                            <section class="fix"></section>
                        </div>
                    </div>
                    <div class="comment-section">
                        <h3>Add a Comment</h3>
                        {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'comment-form']) !!}
                            {!! Form::textarea('body', '', ['placeholder' => 'Type your comment...']) !!}
                            {!! Form::hidden('post-id', $post->id)!!}
                            <button form="comment-form" type="submit" class='comment-btn'><i class="far fa-comment-dots"></i></button>
                        {!! Form::close() !!}
                        <section class="fix"></section>
                    </div>
            @endforeach
        </div>

            <input id="user-id" type="hidden" value="{{$user->id}}">
            <div id="load-more-div">
            @if(Auth::user()->id == $user->id)
                <button id="load-more-profile">Load more posts</button>
            @else
                <button id="load-more-profile-user">Load more posts</button>
            @endif
            </div>

        @else
            @if(Auth::user()->id == $user->id)
                <div class="post-container">
                    <div class="message">
                        <h4>Share your first post...</h4>
                    </div>
                </div>
            @else
                <div class="post-container">
                    <div class="message">
                        <h4><span>{{$user->fname}}</span> hasn't share anyposts yet.</h4>
                    </div>
                </div>
            @endif

        @endif
    </div>
</main>

@endsection