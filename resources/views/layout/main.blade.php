<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'XM') - XM PHP Exercise</title>

    @include('layout.styles')

    @yield('styles')
</head>

<body>
@yield('header')

<main id="main" class="main">
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">XM.com</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarText">
                <ul class="navbar-text navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @include('alert')
    @yield('content')
</main>

@yield('footer')
@include('layout.script')
@yield('bottom-scripts')
</body>

</html>
