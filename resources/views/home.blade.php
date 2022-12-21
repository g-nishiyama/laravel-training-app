{{--  引用元：「7.ログイン認証」https://newmonz.jp/lesson/laravel-basic/chapter-7  --}}
{{--  引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
<h1 class="page-heading">マイページ</h1>
{{--  ログインユーザー名の表示、記事新規登録画面への遷移リンク表示  --}}
<p>ようこそ、{{ Auth::user()->name }}さん｜<a href="{{ route('articles.create') }}">記事を書く</a></p>
{{--  サブビューのarticles.blade.phpを読み込み  --}}
@include('articles.articles')
@endsection()