{{--  引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4  --}}
{{--  引用元：「5.記事の詳細と編集」https://newmonz.jp/lesson/laravel-basic/chapter-5  --}}
{{--  登録・編集では画面構成が似ているためサブビューとしてフォーム部分を切り分け  --}}

{{--  不正リクエスト（クロス・サイト・リクエスト・フォージェリ(CSRF)）からアプリケーションを保護
        form要素内に@csrfを記載することで以下のようなinput要素を自動で生成してくれる。
        <input type="hidden" name="_token" value="8r1l1dsOd0ksCDlQwus2OXm35DbIfgMMtjsRa4jo">
        valueの値(ランダム生成のトークン)を含まないリクエストは不正として扱われる。
--}}
@csrf
<div class="row">
    <div class="col-4 mb-3">
        <label for="FormControlTitle" class="form-label">タイトル</label>
        <input type="text" class="form-control" id="FormControlTitle" name="title" value="{{ old('title', $article->title) }}">
    </div>
</div>
<div class="row">
    <div class="col-4 mb-3">
        <label for="FormControlBody" class="form-label">本文</label>
        <textarea class="form-control" id="FormControlBody" name="body" rows="5">{{ old('body', $article->body) }}</textarea>
    </div>
</div>