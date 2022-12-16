{{--  引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4  --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/main.css">
</head>
<body>
    <header>
        <div class="site-title">ミニブログ</div>
    </header>
    <main class="container">
        {{--  フォーム入力内容をweb.phpに設定されたルーティングarticles.store(ArticleControllernのstoreメソッド)へPOSTメソッドで送信する  --}}
        <form action="{{ route('articles.store') }}" method="post">
            {{--  不正リクエスト（クロス・サイト・リクエスト・フォージェリ(CSRF)）からアプリケーションを保護
                  form要素内に@csrfを記載することで以下のようなinput要素を自動で生成してくれる。
                  <input type="hidden" name="_token" value="8r1l1dsOd0ksCDlQwus2OXm35DbIfgMMtjsRa4jo">
                  valueの値(ランダム生成のトークン)を含まないリクエストは不正として扱われる。
            --}}
            @csrf
            <dl class="form-list">
                <dt>タイトル</dt>
                <dd><input type="text" name="title"></dd>
                <dt>本文</dt>
                <dd><textarea name="body" rows="5"></textarea></dd>
            </dl>
            {{--  投稿ボタンを表示　送信先は<form>のaction要素に記載した{{ route('articles.store') }}  --}}
            <button type="submit">投稿する</button>
            {{--  キャンセルリンクを表示　遷移先は一覧ページ(web.phpに設定されたルーティングarticles.index(ArticleControllerのindexメソッド))  --}}
            <a href="{{ route('articles.index') }}">キャンセル</a>
        </form>
    </main>
    <footer>
        &copy; Laravel8 入門〜開発実践まで
    </footer>
</body>
</html>