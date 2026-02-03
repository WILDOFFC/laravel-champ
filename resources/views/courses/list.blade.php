<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        svg {
            width: 2rem;
        }
    </style>
</head>
<body>
<a href="{{ route('courses.create') }}">Создать курс</a>
@foreach($courses as $course)
    <h1>{{ $course->name }}</h1>
    <h2>{{ $course->description }}</h2>
    <h3>{{ $course->hours }}</h3>
    <h4>{{ $course->price }}</h4>
    <h5>{{ $course->start_date }}</h5>
    <h5>{{ $course->end_date }}</h5>
    <img src="{{ $course->img }}" alt="Превью курса">
    <a href="{{ route('courses.edit', $course) }}">Редактировать</a>
    <form action="{{ route('courses.destroy', $course) }}" method="POST">
    @csrf
    @method('DELETE')
        <input type="submit" value="Удалить">
    </form>
@endforeach
{{ $courses->links() }}
</body>
</html>
