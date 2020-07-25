@extends('layouts.app')

@section('css-page')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comment-style.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="post-container">
    <div class="post">
        <div class="post-head">
            <a href="/@if(Auth::user()->id == $post->user_id)profile
                @elseif(Auth::user()->id != $post->user_id)profile/{{$post->user_id}}
                @endif">
                <img src="/storage/images/{{$post->user->profile_pic}}" title="{{$post->user->fname}} {{$post->user->lname}}">
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
                
                @if (auth()->user()->isFollowing($post->user->id))
                    <td>
                        <form action="{{route('unfollow', ['id' => $post->user->id])}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" id="delete-follow-{{ $post->user->id }}" class="unfollow">
                                <i class="fa fa-btn fa-trash"></i> Unfollow
                            </button>
                        </form>
                    </td>
                @else
                    <td>
                        <form action="{{route('follow', ['id' => $post->user->id])}}" method="POST">
                            {{ csrf_field() }}

                            <button type="submit" id="follow-user-{{ $post->user->id }}" class="follow">
                                <i class="fa fa-btn fa-user"></i> Follow
                            </button>
                        </form>
                    </td>
                @endif

            @endif

        </div>
        <section class="fix"></section>

        <div class="post-details">
            <div class="content">
                <p>{{$post->body}}</p>
            </div>
            {!! Form::open(['action' => ['PostsController@update', $post->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'edit-form', 'id' => 'edit-form']) !!}
                {!! Form::textarea('body', $post->body, ['cols' => '10', 'rows' => '2', 'placeholder' => "What's in your mind ?..."]) !!}
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
    <div class="comments-container">
        @if($post->comments_num > 0)
            @foreach ($comments as $comment)
                <div class="comment-slice">

                    <!-- Picture, Name, Date and Edit btn -->
                    <div class="comment-head">
                        <a href="/@if(Auth::user()->id == $comment->user_id)profile
                            @elseif(Auth::user()->id != $comment->user_id)profile/{{$comment->user_id}}
                            @endif">
                            <img src="/storage/images/{{$comment->user->profile_pic}}" title="{{$comment->user->fname}} {{$comment->user->lname}}">
                            <div class="head-details">
                                <h3>{{$comment->user->fname}} {{$comment->user->lname}}</h3>
                                <p class="date">{{$comment->created_at}}</p>
                            </div>
                        </a>

                        @if(Auth::user()->id == $comment->user_id)
                            <div class="head-button">
                                <button class="more-comment"><i class="fas fa-ellipsis-v"></i></button>
                                <div class="optiones-comment">
                                    <button class="edit-btn-comment"><i class="fas fa-pencil-alt"></i> Edit</button>
                                    {!! Form::open(['action' => ['CommentsController@destroy', $comment->id], 'method' => 'POST', 'id' => 'comment-detele-form' . $comment->id]) !!}
                                        <button type="submit" form="comment-detele-form{{$comment->id}}" class="delete-btn"><i class="fas fa-trash-alt"></i> Delete</button>
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
            
                        @else
                            <div class="head-button" style="display: none;">
                                <button class="more-comment"><i class="fas fa-ellipsis-v"></i></button>
                                <div class="optiones-comment">
                                    <button class="edit-btn-comment"><i class="fas fa-pencil-alt"></i> Edit</button>
                                    {!! Form::open(['id' => 'detele-form']) !!}
                                        <button type="submit" class="delete-btn"><i class="fas fa-trash-alt"></i> Delete</button>
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
            
                        @endif
                    </div>
                    <!-- End -->
                <section class="fix"></section>
                

                <!-- Comment's Content -->
                <div class="comment-details">
                    <div class="content-comment">
                        <p>{{$comment->body}}</p>
                    </div>
                    {!! Form::open(['action' => ['CommentsController@update', $comment->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'edit-form-comment', 'id' => 'edit-form-comment' . $comment->id]) !!}
                        {!! Form::textarea('body', $comment->body, ['cols' => '30', 'rows' => '10', 'placeholder' => "What's in your mind ?..."]) !!}
                        {!! Form::hidden('_method', 'PUT')!!}
                    {!! Form::close() !!}
                </div>
                <!-- End -->

                <!-- Like Section -->
                <div class="comment-action">
                    <div class="right-action-comment">
                        {!! Form::submit('Save', ['class' => 'ebs-comment', 'form' => 'edit-form-comment' . $comment->id]) !!}
                        <button class="ebc-comment" type="button">Cancel</button>
                    </div>
                    <section class="fix"></section>
                </div>
                <!-- End -->
            
        </div>
            @endforeach
        @else
            <p><i class="fas fa-comment-alt"></i><br>Be the first comment <i class="far fa-smile"></i></p>
        @endif
    </div>
    <div class="comment-section post-comment-section">
        <h3>Add a Comment</h3>
        {!! Form::open(['action' => 'CommentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'comment-form']) !!}
            {!! Form::textarea('body', '', ['placeholder' => 'Type your comment...']) !!}
            {!! Form::hidden('post-id', $post->id)!!}
            {{-- {!! Form::submit('<i class="far fa-comment-dots"></i>', ['class' => 'comment-btn']) !!} --}}
            <button form="comment-form" type="submit" class='comment-btn'><i class="far fa-comment-dots"></i></button>
        {!! Form::close() !!}
        <section class="fix"></section>
    </div>
</div>

@endsection