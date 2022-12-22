<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>
    <header>
        <a href="/" class="site-title">ミニブログ</a>
        {{--  引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8  --}}
        <nav class="tab">
            <ul>
                {{--  ログイン済みかどうか確認  --}}
                @if (Auth::check())
                {{--  ログイン済みの場合、マイページへのリンク表示  --}}
                <li><a class="tab-item{{ Request::is('home') ? ' active' : ''}}" href="{{ route('home') }}">マイページ</a></li>
                {{--  ログイン済みの場合、記事検索へのリンク表示  --}}
                <li><a class="tab-item{{ Request::is('articles') ? ' active' : ''}}" href="{{ route('articles.index') }}">記事検索</a></li>
                {{--  ログイン済みの場合、ブックマークへのリンク表示  --}}
                <li><a class="tab-item{{ Request::is('bookmarks') ? ' active' : ''}}" href="{{ route('bookmarks') }}">ブックマーク</a></li>
                <li>
                    {{--  ログイン済みの場合、ログアウトボタンを表示　ログアウトボタン押下した場合は確認画面を表示  --}}
                    <form on-submit="return confirm('ログアウトしますか？')" action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit">ログアウト</button>
                    </form>
                </li>
                @else 
                {{--  ログイン済みではない場合、ログイン画面へのリンクを表示  --}}
                <li><a href="{{ route('login') }}">ログイン</a></li>
                {{--  ログイン済みではない場合、会員登録画面へのリンクを表示  --}}
                <li><a href="{{ route('register') }}">会員登録</a></li>
                @endif
            </ul>
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