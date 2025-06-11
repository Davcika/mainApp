<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/regStyle.css') }}">
</head>
<body>
<div id="pageWrapper">
    @auth

    <div id="authContainer">
        <div id="logout">

            <form action="/logout" method="POST">
                @csrf
                <button>Logout</button>
            </form>

            @if ($user['karma'] < 0)
                <h3 style="color: brown">karma {{$user['karma']}}</h3>
            @else
                <h3 style="color: rgb(23, 93, 70)">karma {{$user['karma']}}</h3>
            @endif
        </div>

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
                @foreach ($posts as $post)
                <div class="singlePost">
                    <h3>{{ $post['title'] }}</h3>
                    <a style="color: blue" href="/profile/{{ $post->user->id }}">{{ $post->user->name }}</a>
                    <p>{{ $post['body'] }}</p>
                    @if($post->answer)
                    <h3>Atbildeja: {{ $post->answer->user->name }}</h3>
                    <p>{{ $post->answer->body }}</p>
                    @endif
                    <span>🫀 ⬅ <span style="color: brown; font-weight: bold; font-size: 1rem; font-family: 'Roboto Mono', monospace;">({{ $post['likes'] }})</span></span>
                    @if(!$post->answer && $post->user->id !== Auth::id())
                    <p><a href="/answer-post/{{ $post->id }}">Answer post</a></p>
                    @endif
                    
                    @if($post->answer)
                    <form action="/like" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button style="color: rgb(23, 93, 70)">Like</button>
                    </form>

                    <form action="/dislike" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <button style="color: brown">Dislike</button>
                    </form>
                    @endif

                    @if($post->user->id == Auth::id())
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