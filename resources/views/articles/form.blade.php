{{--  引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4  --}}
{{--  登録・編集では画面構成が似ているためサブビューとしてフォーム部分を切り分け  --}}

{{--  不正リクエスト（クロス・サイト・リクエスト・フォージェリ(CSRF)）からアプリケーションを保護
        form要素内に@csrfを記載することで以下のようなinput要素を自動で生成してくれる。
        <input type="hidden" name="_token" value="8r1l1dsOd0ksCDlQwus2OXm35DbIfgMMtjsRa4jo">
        valueの値(ランダム生成のトークン)を含まないリクエストは不正として扱われる。
--}}
@csrf
<dl class="form-list">
    <dt>タイトル</dt>
    <dd><input type="text" name="title"></dd>
    <dt>本文</dt>
    <dd><textarea name="body" rows="5"></textarea></dd>
</dl>