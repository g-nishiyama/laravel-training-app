<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // モデルクラスのArticleのスタティックメソッド all() を呼び出し（articlesテーブルから全データ取得）
        $articles = Article::all();
        // 取得した記事データをキー'articles'の連想配列に格納
        $data = ['articles' => $articles];
        // articles.indexのviewに連想配列データを渡す
        return view('articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4
        // Articleクラスをインスタンス化
        $article = new Article();
        // キーarticle、値$articleの連想配列を格納
        $data = ['article' => $article];
        // articles.createのviewに連想配列データを渡す（viewファイルの配置場所が深い場合はその分ドットで繋げて指定する、スラッシュで区切ることもできる）
        return view('articles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}