<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // articlesテーブルから作成日を降順にソートしてページネーションで1ページ10件に区切ったデータを取得
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
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
    public function store(StoreArticleRequest $request)
    {
        // Articleクラスをインスタンス化
        $article = new Article();
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // $articleのuser_idプロパティにAuthファサードで取得したログインユーザーのidを代入
        // ※Authファサードとコントローラは別の名前空間にあるためバックスラッシュを付けた絶対パスで指定する必要がある
        $article->user_id = \Auth::id();
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
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // アクセス権限ポリシーを適用
        $this->authorize($article);
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
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // アクセス権限ポリシーを適用
        $this->authorize($article);
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
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // アクセス権限ポリシーを適用
        $this->authorize($article);
        // 引用元：「6.記事の削除」https://newmonz.jp/lesson/laravel-basic/chapter-6
        // delete()メソッドで$article値を削除
        $article->delete();
        // ルートarticles.indexへリダイレクト
        return redirect(route('articles.index'));
    }

    /**
     * ブックマークした記事の一覧を取得するメソッド定義
     *
     * 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
     */
    public function bookmark_articles()
    {
        // ログインユーザーがブックマークした記事を日付を降順にソートして、ページネーションで1ページあたり10件に区切ったデータを取得
        // ※paginate() の場合は記事のコレクションだけでなくページ情報も含めて保持しているページネータオブジェクトを取得する。
        $articles = \Auth::user()->bookmark_articles()->orderBy('created_at', 'desc')->paginate(10);
        // 取得した記事データをarticlesをキーとした連想配列に格納
        $data = [
            'articles' => $articles,
        ];
        // articles.bookmarksのviewに連想配列データを渡す
        return view('articles.bookmarks', $data);
    }
}
