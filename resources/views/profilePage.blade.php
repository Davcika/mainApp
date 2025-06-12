<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/profilePage.css') }}">
    <title>Document</title>
</head>
<body>
    <h1>Profile page: {{ $user->name }}</h1>
    <h4>Profile created at: {{ $user->created_at }}</h4>
    <h4>🫀 {{ $karma }}</h4>
    <h2>History:</h2>
    @foreach($user->posts as $post)
    <div id="divs" style="border-style: dashed; border-width: 1px;">
        <h3>{{ $post->title }}</h3>
        <h3>{{ $post->body }}</h3>
        @if($post->answer)
        <h3>{{ $post->answer->body}}</h3>
        @endif
    </div>
    @endforeach
    
    <form action="/set-background" method="POST">
        @csrf
        <div style="padding-top: 3px">
        <input type="text" id="urlInput" placeholder="Paste Image Url here..." name="background">
        <button>Set Background</button>
        </div>
    </form>
    <a href="/exit">Exit</a>
    <div class="background" id="background"
    style="background-image: url('{{ $user->background }}');">
    </div>


</body>
</html>