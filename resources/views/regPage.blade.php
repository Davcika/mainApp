<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/regStyle.css') }}">
</head>
<body>
<div id="page">
    @auth {{--Viss ko redzēs ielogojies/registrejies lietotajs--}}
    <div id="authContainer">
        {{--Iespeja atvienoties no sesijas--}}
        <div id="logout">
            <form action="/logout" method="POST">
                @csrf
                <button>Logout</button>
            </form>
                <h3>User: <a href="/profile-page/{{ $user->id }}">{{ $user->name }}</a></h3>
                <h3 style="color: brown">🫀 {{ $user->karma() }}</h3>
        </div>

        {{--Viss kas saistits ar postu--}}
        <div id="paperPost">
            <h2>Create Post</h2>
            <form action="/create-post" method="POST" id="postForm">
                @csrf
                <input type="text" name="title" placeholder="post title" class="postInput">
                <textarea name="body" placeholder="text here..." class="postTextarea"></textarea>
                <button>Save text</button>
            </form>

            <div id="postsContainer">
                <h2>All posts</h2>
                {{--Tiek no masīva iznemti posti pa vienam un parbauditi uz dažādām kondīcijām--}}
                @foreach ($posts as $post)
                <div class="singlePost">
                    <h3>{{ $post['title'] }}</h3>
                    {{--Iespēja apskatīties lietotāja darbību vēsturi ar root piekļuvi--}}
                    @if(Auth::user()->name == 'root')
                    <a style="color: blue" href="/profile/{{ $post->user->id }}">{{ $post->user->name }}</a>
                    @else
                    <p style="color: blue">{{ $post->user->name }}</p>
                    @endif
                    <p>{{ $post['body'] }}</p>
                    {{--Ja ir atbilde postam tad tā tiek attēlota--}}
                    @if($post->answer)
                    <h3>Atbildeja: {{ $post->answer->user->name }}</h3>
                    <p>{{ $post->answer->body }}</p>
                    @endif
                    {{--Liedz atbildēt uz savu veidoto postu--}}
                    @if(!$post->answer && $post->user->id !== Auth::id())
                    <p><a href="/answer-post/{{ $post->id }}">Answer post</a></p>
                    @endif
                    
                    {{--Mainīgie lai parbauditu nolaikotos postus un skaitītu to laikus--}}
                    @if($post->answer)
                    @php
                    $alreadyLiked = $post->likes->contains('user_id', auth()->id());
                    $likeCount = \App\Models\Like::where('post_id', $post->id)->count();
                    @endphp

                    <span>🫀 ⬅ <span style="color: brown; font-weight: bold; font-size: 1rem; font-family: 'Roboto Mono', monospace;">({{ $likeCount}})</span></span>
                    {{--Lauj lietotajam novertet postu, bet tikai vienu reizi--}}
                    @if(!$alreadyLiked && $post['user_id'] !== Auth::id() && $post->answer['user_id'] !== Auth::id())
                    <form action="/like" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="answer_id" value="{{ $post->answer->id }}">
                        <button style="color: rgb(23, 93, 70)">Like</button>
                    </form>
                    @endif
                    @endif
                    {{--Ja tas posts ir tevis veidots tad ir iespeja to izdzest--}}
                    @if($post->user->id == Auth::id())
                    <a href="/edit-post/{{ $post->id }}"><button>Edit post</button></a>
                    <form action="/delete-post/{{ $post->id }}" method="POST">
                        @csrf
                        @method ('DELETE')
                        <button>Delete post</button>
                    </form>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

        {{--Registrešanās, ja lietotajs nav ielogojies--}}
        @else
        <h1 id="title">Quick Q&A</h1>
        <div id="register">

            <form action="/register" method="POST">
                <h2>Register</h2>
                @csrf
                <input type="text" name="name" placeholder="name" class="regItem">
                <input type="text" name="email" placeholder="email" class="regItem">
                <input type="password" name="password" placeholder="password" class="regItem">
                <button>Register</button>
            </form>

            <form action="/login" method="POST">
                <h2>Login</h2>
                @csrf
                <input type="text" name="loginname" placeholder="name" class="loginItem">
                <input type="password" name="loginpassword" placeholder="password" class="loginItem">
                <button>Login</button>
            </form>
        
        </div>
        @endauth
</div>
</body>
</html>