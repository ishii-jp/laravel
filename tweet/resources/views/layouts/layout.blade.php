<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css">
  </head>
    <body>
        <h1>@yield('title')</h1>
        <div>
          <ul>
              @if (Auth::check())
                  <li><a href="/logout">ログアウト</a></li> 
              @else
                  <li><a href="/login">ログイン</a></li>
                  <li><a href="/register">新規登録</a></li>
              @endif
          </ul>
        </div>
        @yield('content')
        @yield('footer')
    </body>
</html>