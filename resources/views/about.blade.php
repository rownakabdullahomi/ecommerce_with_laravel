<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Page</title>
</head>
<body>
    @php

    @endphp
   <a href="{{ url("contact") }}">Contact Page</a>
   <a href="{{ url("/") }}">Welcome Page</a>

    @for($i=0; $i<5; $i++)
        <h1>{{ $i }}</h1>
    @endfor
</body>
</html>
