<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toaster Admin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
</head>
<body>
    <div class="container lg:container xl:container mx-auto h-full w-full">
        @include("admin.nav")
        @yield('content')
    </div>
</body>
</html>