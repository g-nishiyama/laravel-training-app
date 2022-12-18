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
    {{--  $articleのtitleキーの値を表示  --}}
    <div class="article-title">{{ $article->title }}</div>
    {{--  $articleのbodyキーの値を表示  --}}
    <div class="article-body">{{ $article->body }}</div>
</article>
{{--  @foreach閉じタグ  --}}
@endforeach
{{--  @endsection閉じタグ  --}}
@endsection()