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
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navi" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <div class="collapse navbar-collapse" id="bs-navi">
            <ul class="nav navbar-nav">
              <li><a href="/tweet">トップページ</a></li>
              @if (Auth::check())
                <li><a href="/logout">ログアウト</a></li>
                <li><a href="/mypage">マイページ</a></li>
              @else
                <li><a href="/login">ログイン</a></li>
                <li><a href="/register">新規登録</a></li>
              @endif
            </ul>
          </div>
        </div>
    </nav>
    @yield('content')
    @include('footer')
    </body>
</html>