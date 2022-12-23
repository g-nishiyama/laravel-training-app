{{--  引用元：「5.記事の詳細と編集」https://newmonz.jp/lesson/laravel-basic/chapter-5  --}}
{{--  @extendsディレクティブ　使用するレイアウトテンプレートのファイル名(layoutsフォルダのapp.blade.php)を指定  --}}
@extends('layouts.app')
{{--  @sectionディレクティブ　テンプレートファイル(app.blade.php)の@yield(content)部分に埋め込む処理範囲を設定  --}}
@section('content')
{{--  @includeディレクティブ　切り分けたサブビュー(commonsフォルダのerrors.blade.php)を読み込み  --}}
@include('commons.errors')
{{--  フォーム入力内容をweb.phpに設定されたルーティングarticles.update(ArticleControllernのupdateメソッド)へPOSTメソッドで送信する  --}}
<form action="{{ route('articles.update', $article) }}" method="post">
    {{--  methodディレクティブ HTML構文ではmethod属性にpostかgetしか指定出来ないようになっているため、
          methodディレクティブを記述することで隠しパラメータとしてtype属性がhiddenのinputが作成される。
　          <input type="hidden" name="_method" value="patch">
          ここで指定されたmethodの内容に合わせてLaravel側でどの処理かを判断してpatchメソッド処理が呼び出される。
      --}}
    @method('patch')
    {{--  @includeディレクティブ　切り分けたサブビュー(articlesフォルダのform.blade.php)を読み込み  --}}
    @include('articles.form')
    {{--  更新ボタンを表示　送信先は<form>のaction要素に記載した{{ route('articles.update') }}  --}}
    <button type="submit" class="btn btn-primary">更新する</button>
    {{--  キャンセルリンクを表示　遷移先は一覧ページ(web.phpに設定されたルーティングarticles.show(ArticleControllerのshowメソッド))  --}}
    <a href="{{ route('articles.show', $article) }}">キャンセル</a>
</form>
@endsection()