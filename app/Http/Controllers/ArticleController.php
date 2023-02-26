<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArticleService $articleService)
    {
        $data = $articleService->index();
        // articles.indexのviewに連想配列データを渡す
        return view('articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ArticleService $articleService)
    {
        $data = $articleService->create();
        // articles.createのviewに連想配列データを渡す（viewファイルの配置場所が深い場合はその分ドットで繋げて指定する、スラッシュで区切ることもできる）
        return view('articles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request, ArticleService $articleService)
    {
        $articleService->store($request);
        // 記事一覧へリダイレクト（ページ遷移）
        // web.phpに記載したルーティングarticles.indexへリダイレクト
        // 画面表示のときは「return view()」、登録更新削除の場合は「return redirect()」を使う
        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    // タイプヒンティング(引数の型指定)でArticleインスタンスを引数経由で受けとりビューに渡す
    public function show(Article $article, ArticleService $articleService)
    {
        $data = $articleService->show($article);
        // articles.showのviewに連想配列データを渡す
        return view('articles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article, ArticleService $articleService)
    {
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // アクセス権限ポリシーを適用
        $this->authorize($article);
        $data = $articleService->edit($article);
        // articles.editのviewに連想配列データを渡す
        return view('articles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article, ArticleService $articleService)
    {
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // アクセス権限ポリシーを適用
        $this->authorize($article);
        $article = $articleService->update($request, $article);
        // 詳細画面へリダイレクト（ページ遷移）
        // web.phpに記載したルーティングarticles.showへリダイレクト
        // 画面表示のときは「return view()」、登録更新削除の場合は「return redirect()」を使う
        return redirect(route('articles.show', $article));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article, ArticleService $articleService)
    {
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // アクセス権限ポリシーを適用
        $this->authorize($article);
        $articleService->destroy($article);
        // ルートarticles.indexへリダイレクト
        return redirect(route('articles.index'));
    }

    /**
     * ブックマークした記事の一覧を取得するメソッド定義
     *
     * 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
     */
    public function bookmark_articles(ArticleService $articleService)
    {
        $data = $articleService->bookmark_articles();
        // articles.bookmarksのviewに連想配列データを渡す
        return view('articles.bookmarks', $data);
    }
}
