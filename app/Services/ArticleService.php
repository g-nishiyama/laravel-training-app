<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleService
{
    public function index()
    {
        // articlesテーブルから作成日を降順にソートしてページネーションで1ページ10件に区切ったデータを取得
        $articles = Article::orderBy('created_at', 'desc')->paginate(10);
        // 取得した記事データをキー'articles'の連想配列に格納
        $data = ['articles' => $articles];
        return $data;
    }

    public function create()
    {
        // 引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4
        // Articleクラスをインスタンス化
        $article = new Article();
        // キーarticle、値$articleの連想配列を格納
        $data = ['article' => $article];
        return $data;
    }

    public function store($request)
    {

        //拡張子付きで画像名を取得
        $imagenameWithExt = $request->file("image")->getClientOriginalName();
        //画像名のみを取得
        $imagename = pathinfo($imagenameWithExt, PATHINFO_FILENAME);
        //拡張子を取得
        $extension = $request->file("image")->getClientOriginalExtension();
        //保存の画像名を構築
        $imagenameToStore = $imagename."_".time().".".$extension;
        //画像を保存、保存パスを取得
        $path = $request->file("image")->storeAs("public/img", $imagenameToStore);

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
        // storage/app/public/任意のディレクトリ名/
        $article->image_path = $imagenameToStore;

        // $articleプロパティにセットされた値を保存してレコード追加
        $article->save();
        return $article;
    }

    public function show($article)
    {
        // キーarticle、値$articleの連想配列を格納
        $data = ['article' => $article];
        return $data;
    }

    public function edit($article)
    {
        // キーarticle、値$articleの連想配列を格納
        $data = ['article' => $article];
        return $data;
    }

    public function update($request, $article)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            //拡張子付きで画像名を取得
            $imagenameWithExt = $request->file("image")->getClientOriginalName();
            //画像名のみを取得
            $imagename = pathinfo($imagenameWithExt, PATHINFO_FILENAME);
            //拡張子を取得
            $extension = $request->file("image")->getClientOriginalExtension();
            //保存の画像名を構築
            $imagenameToStore = $imagename."_".time().".".$extension;
            //画像を保存、保存パスを取得
            $path = $request->file("image")->storeAs("public/img", $imagenameToStore);
            //既存の古い画像は削除
            if(Storage::exists('public/img/'.$article->image_path)){
                Storage::disk('public')->delete('img/'.$article->image_path);
            }
            // dd(Storage::exists('public/img/'.$article->image_path));

            // storage/app/public/任意のディレクトリ名/
            $article->image_path = $imagenameToStore;
        }
        // $articleのプロパティtitleにフォームから送信されたtitleの値を代入
        $article->title = $request->title;
        // $articleのプロパティbodyにフォームから送信されたbodyの値を代入
        $article->body = $request->body;
        // $articleプロパティにセットされた値を保存してレコード追加
        $article->save();
        return $article;
    }

    public function destroy($article)
    {
        // 引用元：「6.記事の削除」https://newmonz.jp/lesson/laravel-basic/chapter-6
        // 画像の削除
        Storage::disk('public')->delete('img/'.$article->image_path);
        // delete()メソッドで$article値を削除
        $article->delete();
    }

    public function bookmark_articles()
    {
        // ログインユーザーがブックマークした記事を日付を降順にソートして、ページネーションで1ページあたり10件に区切ったデータを取得
        // ※paginate() の場合は記事のコレクションだけでなくページ情報も含めて保持しているページネータオブジェクトを取得する。
        $articles = \Auth::user()->bookmark_articles()->orderBy('created_at', 'desc')->paginate(10);
        // 取得した記事データをarticlesをキーとした連想配列に格納
        $data = [
            'articles' => $articles,
        ];
        return $data;
    }
}