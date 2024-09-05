<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Welcom {{$user->name}},</h1>

    <div style="margin-bottom:20px;">
        <strong>Profile details:</strong>
    </div>
</body>

<form method="post" action="{{route('update.profile')}}">
    {{csrf_field()}}
    <div style="margin-bottom: 20px;">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" value="{{$user->name}}">
    </div>

    <div style="margin-bottom: 20px;">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{{$user->email}}">
    </div>

    <div style="margin-bottom: 20px;">
        {{$user->password}}
    </div>

    <button>Save</button>
</form>

</html>
