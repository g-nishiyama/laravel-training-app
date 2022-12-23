{{--  引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8  --}}
{{--  foreachで繰り返し処理　$articlesから１つずつ取り出し$articleへ代入  --}}
@foreach ($articles as $article)
<article class="article-item">
    {{--  タイトルリンク表示　遷移先は詳細画面(articles.show)  --}}
    <div class="article-title"><a href="{{ route('articles.show', $article) }}">{{ $article->title }}</a></div>
    <div class="article-info">
        {{--  作成日と記事投稿ユーザー名を表示  --}}
        {{ $article->created_at }}｜{{ $article->user->name }}
    </div>
    <div class="article-control">
        {{--  ログインユーザーがブックマークしている記事ではない場合  --}}
        @if (!Auth::user()->is_bookmark($article->id))
        {{--  お気に入り登録ボタン表示（ブックマーク登録処理）  --}}
        <form action="{{ route('bookmark.store', $article) }}" method="post">
            @csrf
            {{--  <button>お気に入り登録</button>  --}}
            <button type="button" class="btn btn-primary">お気に入り登録</button>
        </form>
        @else
        {{--  お気に入り解除ボタン表示（ブックマーク削除処理）  --}}
        <form action="{{ route('bookmark.destroy', $article) }}" method="post">
            @csrf
            {{--  @methodディレクティブ 隠しパラメータでdeleteメソッドを送信  --}}
            @method('delete')
            <button>お気に入り解除</button>
        </form>
        @endif
    </div>
</article>
@endforeach
{{--  各ページへのリンクを生成して表示  --}}
{{--  引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9  --}}
{{ $articles->links() }}