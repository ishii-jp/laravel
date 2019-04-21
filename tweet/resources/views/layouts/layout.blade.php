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
              <li><a href="/tweet" class="btn btn-default active" role="button">トップページ</a></li>
              @if (Auth::check())
                <li><a href="/logout" class="btn btn-default active" role="button">ログアウト</a></li>
                <li><a href="/mypage" class="btn btn-default active" role="button">マイページ</a></li>
              @else
                <li><a href="/login" class="btn btn-default active" role="button">ログイン</a></li>
                <li><a href="/register" class="btn btn-default active" role="button">新規登録</a></li>
              @endif
            </ul>
            @if(Auth::check())
              <p>現在ログイン中のユーザー：{{ Auth::user()->name }}</p>
              <p>最終ログイン日時：{{ Auth::user()->last_login_at }}</p>
            @endif
          </div>
        </div>
    </nav>
    @yield('content')
    </body>
    @include('footer')
</html>