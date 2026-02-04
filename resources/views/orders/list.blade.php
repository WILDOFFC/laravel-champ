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
@foreach($orders as $order)
    <h1>{{ $order->user->email }}</h1>
    <h1>{{ $order->user->name }}</h1>
    <h2>{{ $order->course->name }}</h2>
    <h2>{{ $order->course->start_date }}</h2>
    <h2>{{ $order->course->end_date}}</h2>
    <h3>{{ $order->order->created_at }}</h3>
    <h4>{{ $order->order->status }}</h4>
@endforeach
</body>
</html>
