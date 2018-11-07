<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
  </head>
    <body>
        <h1>@yield('title')</h1>
        @yield('content')
        @yield('footer')
    </body>
</html>