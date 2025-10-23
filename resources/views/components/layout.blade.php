<!DOCTYPE html>
<html>
<head>
    <title>Midterm</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

</head>
<body>
    <div class="container">
        @if(session('status'))
            <div class="notice">{{ session('status') }}</div>
        @endif

        {{ $slot }}
    </div>
</body>
</html>
