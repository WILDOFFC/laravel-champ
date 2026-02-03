<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
@foreach($lessons as $lesson)
    <h1>{{ $lesson->name }}</h1>
    <h2>{{ $lesson->description }}</h2>
    <h3>{{ $lesson->video_link }}</h3>
    <h4>{{ $lesson->hours }}</h4>

    <a href="{{ route('lessons.edit', $lesson) }}">Изменить</a>
    <form action="{{ route('lessons.destroy', $lesson) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="submit" value="Удалить">
    </form>
@endforeach
</body>
</html>
