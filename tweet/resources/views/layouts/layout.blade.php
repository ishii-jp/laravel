<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    @yield('meta')
    <title>@yield('title')</title>
    @yield('css')
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.css') }}">
    <script type="text/javascript" src="{{ asset('/js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.js') }}"></script>
  </head>
    <body>
        <h1>@yield('title')</h1>
        <div>
          <p><a href="/tweet">トップページ</a></p>
              @if (Auth::check())
                  <span><a href="/logout">ログアウト</a></span> 
                  <span><a href="/mypage">マイページ</a></span>
              @else
                  <span><a href="/login">ログイン</a></span>
                  <span><a href="/register">新規登録</a></span>
              @endif
        </div>
        @yield('content')
        @yield('footer')
    </body>
</html>