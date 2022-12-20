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
        // 引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4
        // バリデーションチェック(storeアクションに渡された$requestに格納されている値が定義に合っていることを確認する)
        $this->validate($request, [
            // チェック項目としてtitleが未入力ではないこと、最大文字数は255文字以内であることを定義
            'title' => 'required|max:255',
            // チェック項目としてbodyは未入力ではないことを定義
            'body' => 'required'
        ]);
        // Articleクラスをインスタンス化
        $article = new Article();
        // $articleのプロパティtitleにフォームから送信されたtitleの値を代入
        $article->title = $request->title;
        // $articleのプロパティbodyにフォームから送信されたbodyの値を代入
        $article->body = $request->body;
        // $articleプロパティにセットされた値を保存してレコード追加
        $article->save();

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
    public function show(Article $article)
    {
        // キーarticle、値$articleの連想配列を格納
        $data = ['article' => $article];
        // articles.showのviewに連想配列データを渡す
        return view('articles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        // キーarticle、値$articleの連想配列を格納
        $data = ['article' => $article];
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
    public function update(Request $request, Article $article)
    {
        // 引用元：「5.記事の詳細と編集」https://newmonz.jp/lesson/laravel-basic/chapter-5
        // バリデーションチェック(updateアクションに渡された$requestに格納されている値が定義に合っていることを確認する)
        $this->validate($request, [
            // チェック項目としてtitleが未入力ではないこと、最大文字数は255文字以内であることを定義
            'title' => 'required|max:255',
            // チェック項目としてbodyは未入力ではないことを定義
            'body' => 'required'
        ]);
        // $articleのプロパティtitleにフォームから送信されたtitleの値を代入
        $article->title = $request->title;
        // $articleのプロパティbodyにフォームから送信されたbodyの値を代入
        $article->body = $request->body;
        // $articleプロパティにセットされた値を保存してレコード追加
        $article->save();
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
    public function destroy(Article $article)
    {
        //
    }
}
