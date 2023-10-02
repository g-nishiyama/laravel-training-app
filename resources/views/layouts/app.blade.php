<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/main.css">
    {{--  readmore機能用JSファイイル読み込み  --}}
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    {{--  ニコモジフォント導入  --}}
    <link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
    {{--  fontawesome導入  --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    {{--  vite.config.jsで'resources/css/app.css'を追加したのでそこからCSSを読み込む  --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{--  image_view.jsの読み込み  --}}
    @vite('resources/js/image_view.js')
    {{--  readmore.jsの読み込み  --}}
    @vite('resources/js/readmore.js')
</head>
<body>
    <header class="mb-5">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">ミニブログ</a>
            {{--  ログイン済みかどうか確認  --}}
            @if (Auth::check())
                <ul class="navbar-nav">
                {{--  ログイン済みの場合、マイページへのリンク表示  --}}
                <li class="nav-item"><a class="nav-link tab-item{{ Request::is('home') ? ' active' : ''}}" href="{{ route('home') }}">マイページ</a></li>
                {{--  ログイン済みの場合、記事検索へのリンク表示  --}}
                <li class="nav-item"><a class="nav-link tab-item{{ Request::is('articles') ? ' active' : ''}}" href="{{ route('articles.index') }}">記事検索</a></li>
                {{--  ログイン済みの場合、ブックマークへのリンク表示  --}}
                <li class="nav-item"><a class="nav-link tab-item{{ Request::is('bookmarks') ? ' active' : ''}}" href="{{ route('bookmarks') }}">ブックマーク</a></li>
                <li>
                    {{--  ログイン済みの場合、ログアウトボタンを表示　ログアウトボタン押下した場合は確認画面を表示  --}}
                    <form on-submit="return confirm('ログアウトしますか？')" action="{{ route('logout') }}" method="post">
                        @csrf
                        {{--  <button type="submit">ログアウト</button>  --}}
                        <button type="submit" class="btn btn-light">ログアウト</button>
                    </form>
                </li>
                </ul>
            @else 
                <ul class="navbar-nav">
                {{--  ログイン済みではない場合、ログイン画面へのリンクを表示  --}}
                <li class="nav-item"><a class="nav-link tab-item{{ Request::is('login') ? ' active' : ''}}" href="{{ route('login') }}">ログイン</a></li>
                {{--  ログイン済みではない場合、会員登録画面へのリンクを表示  --}}
                <li class="nav-item"><a class="nav-link tab-item{{ Request::is('register') ? ' active' : ''}}" href="{{ route('register') }}">会員登録</a></li>
                </ul>
            @endif
            </div>
        </div>
        </nav>

    </header>
    <main class="container">
        {{--  引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4  --}}
        {{--  @yieldディレクティブ（別のbladeファイルで@section(セクション名)～@endsectionの間に記載した内容が埋め込まれた形でHTML生成される）  --}}
        @yield('content')
    </main>
    <footer>
        &copy; Laravel8 入門から開発実践まで
    </footer>
</body>
</html>