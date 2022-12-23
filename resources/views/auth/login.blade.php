{{--  引用元：「7.ログイン認証」https://newmonz.jp/lesson/laravel-basic/chapter-7  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
<h1>ログイン</h1>
{{--  @includeディレクティブ　切り分けたサブビュー(commonsフォルダのerrors.blade.php)を読み込み  --}}
@include('commons.errors')
{{--  Fortifyが用意したルーティングloginへ入力したメールアドレス、パスワードをPOSTで送信  --}}
<form class="mb-1" action="{{ route('login') }}" method="post">
    {{--  不正リクエスト（クロス・サイト・リクエスト・フォージェリ(CSRF)）からアプリケーションを保護  --}}
    @csrf 
    <div class="row">
        <div class="col-4 mb-3">
            <label for="FormControlMail" class="form-label">メールアドレス</label>
            <input type="email" class="form-control" id="FormControlMail" name="email" value="{{ old('email') }}">
        </div>
    </div>
    <div class="row">
        <div class="col-4 mb-3">
            <label for="FormControlPassword" class="form-label">パスワード</label>
            <input type="password" class="form-control" id="FormControlPassword" name="password">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">ログイン</button>
    <a href="/">キャンセル</a>
</form>
@endsection()