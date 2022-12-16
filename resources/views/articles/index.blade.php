<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{--  スタイルシートmain.cssの読み込み  --}}
    <link rel="stylesheet" href="/main.css">
</head>
<body>
    <header>
        <div class="site-title">ミニブログ</div>
    </header>
    <main class="container">
        {{--  投稿ページへのリンク表示  --}}
        <p><a href="{{ route('articles.create') }}">記事を書く</a></p>
        {{--  繰り返し処理（$articlesからキーと値のデータを１つずつ取り出し$articleへ格納）  --}}
        @foreach ($articles as $article)
        <article class="article-item">
            {{--  $articleのtitleキーの値を表示  --}}
            <div class="article-title">{{ $article->title }}</div>
            {{--  $articleのbodyキーの値を表示  --}}
            <div class="article-body">{{ $article->body }}</div>
        </article>
        @endforeach
    </main>
    <footer>
        &copy; Laravel8 入門〜開発実践まで
    </footer>
</body>
</html>