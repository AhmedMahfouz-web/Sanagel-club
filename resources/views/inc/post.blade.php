
    
    @foreach($posts as $post)
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
                            {!! Form::open(['action' => ['LikesController@destroy', $post->id], 'method' => 'POST', 'id' => 'delete-like-form'.$post->id, 'style' => 'display: inline-block;']) !!}
                                <button form="delete-like-form{{$post->id}}" type="submit" class="love-btn">
                                    <i class='love fas fa-heart'></i>
                                    <p class="plove">Loved</p>
                                </button>
                                {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::close() !!}
                            @else
                            {!! Form::open(['action' => 'LikesController@store', 'method' => 'POST', 'id' => 'like-form'.$post->id, 'style' => 'display: inline-block;']) !!}
                                {!! Form::hidden('post-id', $post->id)!!}
                                <button form="like-form{{$post->id}}" type="submit" class="love-btn">
                                    <i class='love far fa-heart'></i>
                                    <p class="plove">Love</p>
                                </button>
                            {!! Form::close() !!}
                            @endif
                        @else
                        {!! Form::open(['action' => 'LikesController@store', 'method' => 'POST', 'id' => 'like-form'.$post->id, 'style' => 'display: inline-block;']) !!}
                            {!! Form::hidden('post-id', $post->id)!!}
                            <button form="like-form{{$post->id}}" type="submit" class="love-btn">
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
                        {!! Form::submit('Save', ['class' => 'ebs', 'form' => 'edit-form']) !!}
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

