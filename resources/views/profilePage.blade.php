<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach($user->posts as $post)
    <div style="border: 5px">
        <p>{{ $post->created_at }}</p>
        <p>{{ $post->title }}</p>
        <p>{{ $post->body }}</p>
    </div>
    @endforeach
</body>
</html>