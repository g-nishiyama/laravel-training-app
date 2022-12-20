{{--  引用元：「7.ログイン認証」https://newmonz.jp/lesson/laravel-basic/chapter-7  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
{{--  @includeディレクティブ　切り分けたサブビュー(commonsフォルダのerrors.blade.php)を読み込み  --}}
@include('commons.errors')
<h1>マイページ</h1>
{{--  認証済みのユーザー名を表示
        ＜Authファサードのよく使うメソッド＞
        Auth::user()・・・ログインユーザーのインスタンスを取得
        Auth::id()・・・ログインユーザーのidを取得
        Auth::check()・・・ログインしていれば true を返す
--}}
<p>ようこそ、{{ Auth::user()->name }}さん</p>
{{--  記事一覧へのリンク表示  --}}
<p><a href="{{ route('articles.index') }}">記事一覧へ</a></p>
{{--  ログアウトボタンの表示　Fortifyが用意したルーティングlogoutへPOSTメソッドで送信する  --}}
<form action="{{ route('logout') }}" method="post">
    {{--  不正リクエスト（クロス・サイト・リクエスト・フォージェリ(CSRF)）からアプリケーションを保護  --}}
    @csrf
    <button type="submit">ログアウト</button>
</form>
@endsection()