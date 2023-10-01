{{--  引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
{{--  @includeディレクティブ　切り分けたサブビュー(commonsフォルダのerrors.blade.php)を読み込み  --}}
@include('commons.errors')
{{--  フォーム入力内容をweb.phpに設定されたルーティングarticles.store(ArticleControllernのstoreメソッド)へPOSTメソッドで送信する  --}}
<form action="{{ route('articles.store') }}" method="post" enctype="multipart/form-data">
    {{--  @includeディレクティブ　切り分けたサブビュー(articlesフォルダのform.blade.php)を読み込み  --}}
    @include('articles.form')
    {{--  投稿ボタンを表示　送信先は<form>のaction要素に記載した{{ route('articles.store') }}  --}}
    <button type="submit" class="btn btn-primary">投稿する</button>
    {{--  キャンセルリンクを表示　遷移先は一覧ページ(web.phpに設定されたルーティングarticles.index(ArticleControllerのindexメソッド))  --}}
    <a href="{{ route('articles.index') }}">キャンセル</a>
</form>
{{--  @endsection閉じタグ  --}}
@endsection()