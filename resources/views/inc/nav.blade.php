{{-- 
<form style="display:none;" action="PostController@store" method="POST" id="publisher">
    <input type="hidden" name="publish" value="yes">
</form> --}}
<header>
    <div class="nav">
        <div class="logo">
            <a href="/">
                <img src="/images/social-green-icon.png" alt="Social Media" title="Social Media">
                <p>Sanagel Club</p>
            </a>
            <section class="fix"></section>
        </div>
        <nav>
            <ul>
                <li>
                    <button title="Post" id="post-btn" onclick="post()"><i class="fas fa-edit"></i></button>
                    <div class="add-post">
                        <div class="share-option">
                            <label for="share-with">Share With : </label>
                            <select name="share-with" id="">
                                <option value="public"><span class="fas fa-edit"></span>Public</option>
                                <option value="friends">Friends</option>
                                <option value="me">Only Me</option>
                            </select>
                        </div>
                        {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            {!! Form::textarea('body', '', ['cols' => '30', 'rows' => '10', 'placeholder' => "What's in your mind ?..."]) !!}
                            <label for="file">Upload image :</label>
                            {!! Form::file('post_img') !!}
                            {!! Form::submit('Share', ['class' => 'share']) !!}
                        {!! Form::close() !!}
                    </div>
                </li>
                <li><a href="/"><button title="Home"><i class="fas fa-home"></i></button></a></li>
                <li> 
                    <button title="Notifcation" id="notificationBtn" onclick="notifcation()"><i class="fas fa-bell"></i></button>
                    <div class="notifcation-panel" id="notifications-panel">
                        <section class="fix"></section>
                    </div>
                </li>
                <li>
                    <button onclick="profile()"><i class="fas fa-user"></i></button>
                    <div class="profile-option">
                        <a href='/profile'><button><i class="fas fa-user-circle"></i> Profile</button></a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <button>
                                <i class="fas fa-door-open"></i> 
                                Logout
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                                </form>
                            </button>
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <section class="fix"></section>
    </div>
</header>