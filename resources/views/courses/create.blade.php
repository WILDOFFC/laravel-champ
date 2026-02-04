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
<form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <input type="text" name="name">
    <textarea name="description" id="desc" cols="30" rows="10"></textarea>
    <input type="number" name="hours" >
    <input type="number" name="price" >
    <input type="date" name="start_date">
    <input type="date" name="end_date">
    <input type="file" name="img" accept="image/*">
    <input type="submit" value="Изменить">
</form>
</body>
</html>
