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
@foreach($users as $user)
    <h1>{{ $user->email }}</h1>
    <h1>{{ $user->name }}</h1>
    <h2>{{ $user->course->name }}</h2>
    <h2>{{ $user->course->start_date }}</h2>
    <h2>{{ $user-> }}</h2>
@endforeach
</body>
</html>
