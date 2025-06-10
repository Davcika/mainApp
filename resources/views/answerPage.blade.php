<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Answer Page</h2>
    <p>{{ $post->title }}</p>
    <p>{{ $post->body }}</p>
    <div>
        <form action="/create-answer" method="POST">
        @csrf
        <textarea name="body" placeholder="answer here..." class="answerTextarea"></textarea>
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <button>Save answer</button>
        </form>
    </div>
</body>
</html>