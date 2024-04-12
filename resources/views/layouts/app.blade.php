<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Laravel')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        @include('components.header')

        <div class="bg-light pt-3">
            <div class="container">
                @if(session()->has('success'))
                <div class="alert alert-success d-flex align-items-center mb-0" role="alert">
                    <div>{{ session()->get('success') }}</div>
                </div>
                @endif

                @if(session()->has('error'))
                <div class="alert alert-danger d-flex align-items-center mb-0" role="alert">
                    <div>{{ session()->get('error') }}</div>
                </div>
                @endif
            </div>
        </div>

        @yield('content')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/3b2a155ba0.js" crossorigin="anonymous"></script>
    </body>
</html>