{{--  引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
{{--  投稿ページへのリンク表示  --}}
<p><a href="{{ route('articles.create') }}">記事を書く</a></p>
{{--  繰り返し処理（$articlesからキーと値のデータを１つずつ取り出し$articleへ格納）  --}}
@foreach ($articles as $article)
<article class="article-item">
    {{--  $articleのtitleキーの値をリンクとして表示  --}}
    <div class="article-title">
        {{--  route()関数でURLにarticles.showを設定し、引数として$articleのidをパスパラメータに設定。画面表示はリンク表示でタイトルを表示
            引用元：「5.記事の詳細と編集」https://newmonz.jp/lesson/laravel-basic/chapter-5
        --}}
        <a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a>
    </div>
    {{--  $articleのcreated_atキーの値を表示  --}}
    <div class="article-info">{{ $article->created_at }}</div>
</article>
{{--  @foreach閉じタグ  --}}
@endforeach
{{--  @endsection閉じタグ  --}}
@endsection()