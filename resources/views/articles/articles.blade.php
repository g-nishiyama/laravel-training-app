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
</article>
@endforeach