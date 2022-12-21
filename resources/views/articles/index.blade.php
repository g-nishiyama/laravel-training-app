{{--  引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4  --}}
{{--  引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
<h1 class="page-heading">記事検索</h1>
{{--  サブビューのarticles.blade.phpを読み込み  --}}
@include('articles.articles')
{{--  @endsection閉じタグ  --}}
@endsection()