<!DOCTYPE html>
<html>

<head>
    <title>New Post Published</title>
</head>

<body>
    <h1>New Post Published on {{ $post->website->name }}</h1>
    <p><strong>Title:</strong> {{ $post->title }}</p>
    <p><strong>Description:</strong> {{ $post->description }}</p>
    <p>Visit the website: <a href="{{ $post->website->url }}">{{ $post->website->url }}</a></p>
</body>

</html>
