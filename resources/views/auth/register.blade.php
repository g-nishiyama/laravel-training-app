{{--  引用元：「7.ログイン認証」https://newmonz.jp/lesson/laravel-basic/chapter-7  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
<h1>会員登録</h1>
{{--  @includeディレクティブ　切り分けたサブビュー(commonsフォルダのerrors.blade.php)を読み込み  --}}
@include('commons.errors')
{{--  フォーム入力内容をFortifyが用意したルーティングregisterへPOSTメソッドで送信する  --}}
<form action="{{ route('register') }}" method="post">
    {{--  不正リクエスト（クロス・サイト・リクエスト・フォージェリ(CSRF)）からアプリケーションを保護  --}}
    @csrf
    <dl class="form-list">
        <dt>名前</dt>
        {{--  名前入力フォーム表示  --}}
        <dd><input type="text" name="name" value="{{ old('name') }}"></dd>
        <dt>メールアドレス</dt>
        {{--  メールアドレス入力フォーム表示  --}}
        <dd><input type="email" name="email" value="{{ old('email') }}"></dd>
        <dt>パスワード</dt>
        {{--  パスワード入力フォーム表示  --}}
        <dd><input type="password" name="password"></dd>
        <dt>パスワード（確認用）</dt>
        {{--  確認用パスワード入力フォーム表示  --}}
        <dd><input type="password" name="password_confirmation" placeholder="もう一度入力"></dd>
    </dl>
<button type="submit">登録する</button>
<a href="/">キャンセル</a>
</form>
@endsection()