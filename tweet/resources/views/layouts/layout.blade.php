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
          <p><a href="/tweet">トップページ</a></p>
              @if (Auth::check())
                  <span><a href="/logout">ログアウト</a></span> 
                  <span><a href="/tweet/{{ Auth::user()->id }}">マイページ</a></span>
              @else
                  <span><a href="/login">ログイン</a></span>
                  <span><a href="/register">新規登録</a></span>
              @endif
        </div>
        @yield('content')
        @yield('footer')
    </body>
</html>