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
<form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PATCH')
    <input type="text" name="name" value="{{ $course->name }}">
    <textarea name="description" id="desc" cols="30" rows="10">{{ $course->description }}</textarea>
    <input type="number" name="hours" value="{{ $course->hours }}">
    <input type="number" name="price" value="{{ $course->price }}">
    <input type="date" name="start_date" value="{{ $course->start_date->format('Y-m-d') }}">
    <input type="date" name="end_date" value="{{ $course->end_date->format('Y-m-d') }}">
    <input type="file" name="img" accept="image/*" value="{{ $course->img }}">
    <input type="submit" value="Изменить">
</form>
</body>
</html>
