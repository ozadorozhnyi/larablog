<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="You are browsing a simple blog, based on the Laravel framework, created by me especially for the MassMedia Group as a test task.">
        <meta name="author" content="Oleg Zadorozhnyi | ipfound@gmail.com | +380 (97) 992-56-06">
        
        <title>@yield('title') · Blog · MassMedia Group</title>

        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{ asset('assets/css/blog-app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            @include('components.header')
            @include('components.nav')
            @include('components.jumbotron')
            @include('components.commented')
        </div>
        <main role="main" class="container">
            <div class="row">
                @yield('content')
                @include('components.aside')
            </div>
        </main>
        @include('components.footer')
    </body>
</html>