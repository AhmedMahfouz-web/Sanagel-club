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
            {!! Form::hidden('_method', 'DELETE',['class' => '_method']) !!}
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
        @if($post->loves_num > 1)
            Likes
        @else
            Like
        @endif
    </p></a>
    <a href="/posts/{{ $post->id }}"><p class="comments">{{ $post->comments_num }} 
        @if($post->comments_num > 1)
            Comments
        @else
            Comment
        @endif
    </p></a>
    {!! Form::submit('Save', ['class' => 'ebs', 'form' => 'edit-form' . $post->id]) !!}
    <button class="ebc" type="button">Cancel</button>
</div>
<section class="fix"></section>