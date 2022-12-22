{{--  引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
<div class="welcome">
    <h1>Mini Blog</h1>
    {{--  ログイン済みの場合  --}}
    @auth
    {{--  マイページボタンを表示  --}}
    <a class="btn" href="{{ route('home') }}">マイページ</a>
    {{--  ブログを見るボタンを表示  --}}
    <a class="btn" href="{{ route('articles.index') }}">ブログを見る</a>
    {{--  未ログインの場合  --}}
    @else
    {{--  会員登録ボタンを表示  --}}
    <a class="btn" href="{{ route('register') }}">会員登録</a>
    {{--  ログインボタンを表示  --}}
    <a class="btn" href="{{ route('login') }}">ログイン</a>
    @endauth
</div>
@endsection()