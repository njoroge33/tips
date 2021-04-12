<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/new.css') }}" rel="stylesheet">
</head>
<body >
<nav class="navbar navbar-expand-lg  navbar-dark bg-success">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
      aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <div class="mr-auto"><a href="{{ route('home') }}">LOGO</a></div>
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0 font-weight-bold text-uppercase">
        <!-- <li class="nav-item">
          <a class="nav-link" href="#home">Home</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="{{ route('how') }}">How To play</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('terms') }}">Terms and Conditions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#projects">Contact Us</a>
        </li>
        @if (Auth::check())
        <li class="nav-item ">
        <form action="{{ route('logout') }}" method="post" class="col-6" >
        @csrf
            <button type="submit" class="btn btn-sm btn-danger mt-1">Logout</button>
        </form>
        </li>
        @endif

      </ul>
    </div>
  </nav>
    <div id="app">
        <main style="margin-bottom:140px;">
      
            @yield('content')
        </main>

        <div class="text-center bg-success fixed-bottom" id="contacts" style="padding-bottom: 2%;padding-top: 1%;">
        <p><strong>Our Social Media Accounts</strong></p>
    <a href="#" class="text-warning">suretips@gmail.com</a>
    <div>
      <a href="" class="fa fa-twitter-square fa-2x text-info"></a>
      <a href="" target="_blank_" class="fa fa-facebook-square fa-2x" style="color: blue;"></a>
      <a href="" target="_blank_" class="fa fa-instagram fa-2x" style="color: purple;"></a>
      
    </div>


  </div>
    </div>
</body>
</html>