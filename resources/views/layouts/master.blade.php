<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="You are browsing a simple blog, based on the Laravel framework, created by me especially for the MassMedia Group as a test task.">
        <meta name="author" content="Oleg Zadorozhnyi | ipfound@gmail.com | +380 (97) 992-56-06">
        
        <title>@yield('title') · Blog · {{config('app.marketing_name')}}</title>
        
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="{{ asset('assets/css/blog-app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    </head>
    <body>
        {{-- Header & Navigation --}}
        <div class="container">
            @include('partial.header')
            @include('partial.nav')
        </div>
        {{-- Main Content --}}
        <main role="main" class="container mt-4">
            <div class="row">
                @yield('content')
                {{-- Aside Partial --}}
                @include('partial.aside')
            </div>
        </main>
        {{-- Footer --}}
        @include('partial.footer')
        {{-- JavaScript Includes --}}
        @section('javascript')
            {{-- jQuery CDN--}}
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        @show
    </body>
</html>