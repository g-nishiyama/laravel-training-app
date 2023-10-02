{{--  引用元：「5.記事の詳細と編集」https://newmonz.jp/lesson/laravel-basic/chapter-5  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
<article class="article-detail">
    {{--  $articleのtitleキーの値を表示  --}}
    <h1 class="article-title">{{ $article->title }}</h1>
    {{--  $articleのcreated_atキーの値を表示  --}}
    <div class="article-info">{{ $article->created_at }}</div>

    {{--  画像表示  --}}
    @if(empty($article->image_path))
        <img class="image-height" src="{{ asset('img/no-image.png') }}" alt="no-image">
    @else
        <img class="image-height" src="/storage/img/{{$article->image_path}}">
    @endif

    {{--  $articleのbodyキーの値を表示
          １、e() 関数で入力値をエスケープ処理し、改行コードを先にただの文字として表示（htmlspecialchars() を短く書くためのLaravelのヘルパー関数）
                例「こんにちは(改行コード)さようなら」
          ２、文章内の改行コードをPHPの組み込み関数nl2br()で改行タグに変換
                例「こんにちは<br>さようなら」
          ３、{!! !!} エスケープ処理を行わないエコー文を使って改行タグを有効にして表示
                例「こんにちは
                    さようなら」
      --}}
    <div class="article-body" id="read_text">{!! nl2br(e($article->body)) !!}</div>

    {{--  引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8  --}}
    {{--  canディレクティブ　この記事のupdateポリシーがtrueの場合に以降を表示する  --}}
    @can('update', $article)
    <div class="article-control">
        {{--  編集画面へのリンクを表示(web.phpに設定されたルーティングarticles.edit(ArticleControllerのeditメソッド))  --}}
        <a class="btn btn-primary" href="{{ route('articles.edit', $article) }}">編集</a>
        {{--  削除のリンクを表示（web.phpに設定されたルーティングarticles.destroy(ArticleControllernのdestroyメソッド)へPOSTメソッドで送信する  --}}
        {{--  引用元：「6.記事の削除」https://newmonz.jp/lesson/laravel-basic/chapter-6  --}}
        {{--  onsubmitはフォーム送信された時にスクリプトを実行するため、javascriptのconfirmメソッドで確認ダイアログを表示（OKはtrueを返し送信,キャンセルはfalseを返し送信しない）  --}}
        <form onsubmit="return confirm('本当に削除しますか？')" action="{{ route('articles.destroy', $article) }}" method="post">
            {{--  不正リクエスト（クロス・サイト・リクエスト・フォージェリ(CSRF)）からアプリケーションを保護  --}}
            @csrf
            {{--  @methodディレクティブ 隠しパラメータでdeleteメソッドを送信  --}}
            @method('delete')
            <button type="submit" class="btn btn-primary">削除</button>
        </form>
    </div>
    @endcan
</article>

{{--  readmoreの実装  --}}
<script>
$(function () {
    $('#read_text').readmore({
        speed: 700,
        collapsedHeight: 65,
        moreLink: '<div class="text-center"><button type="#" class="btn btn-primary">続きを読む</a></div>',
        lessLink: '<div class="text-center"><button type="#" class="btn btn-primary">閉じる</a></div>'
    });
});
</script>

@endsection