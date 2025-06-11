<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Profile page: {{ $user->name }}</h1>
    <h4>Profile created at: {{ $user->created_at }}</h4>
    <h4>Karma: {{ $karma }}</h4>
    <h2>History:</h2>
    @foreach($user->posts as $post)
    <div>
        <h3>{{ $post->title }}</h3>
        <h3>{{ $post->body }}</h3>
        @if($post->answer)
        <h3>{{ $post->answer->body}}</h3>
        @endif
    @endforeach
    </div>
    <form action="/set-background" method="POST">
        @csrf
        <input type="text" id="urlInput" placeholder="Paste Image Url here..." name="background">
        <button>Set Background</button>
    </form>
    <a href="/exit">Exit</a>
    <div class="background" id="background"
    style="background-image: url('{{ $user->background }}');">
    </div>
    

    <style>
        .background {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            transition: background-image 0.5s ease;
        }
    </style>

    <script>
        function changeBackground(){
            const url = document.getElementById("urlInput").value;
            const bg = document.getElementById("background")

            bg.style.backgroundImage = `url('${url}')`;
        }
        function resetBackground(){
            bg.style.backgroundImage = "none";
        }
    </script>
</body>
</html>