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
@if ($flag == 0)
<form action="{{ route('upload.handle') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <input type="submit" value="Submit">
</form>
@endif
@if ($flag == 1)
<td><a href="{{url('/images',$path)}}">View</a></td>
@endif
@if ($flag ==2 )

<td><a href="{{url('/images','ThongBaoLuong_00224695.pdf')}}">View</a></td>
@endif

</body>
</html>
