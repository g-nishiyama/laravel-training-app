{{--  引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
<h1 class="page-heading">ブックマークした記事</h1>
{{--  サブビューのarticles.blade.phpを読み込み  --}}
@include('articles.articles')
@endsection()