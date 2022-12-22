<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    // 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
    //多対多リレーションを定義したリソースはattach()メソッドで追加、detach()メソッドで削除することができる
    public function store($articleId) {
        // ログイン済みユーザー情報を取得
        $user = \Auth::user();
        // 現在のユーザーに$articleIdに該当する記事がブックマークされていない場合
        if (!$user->is_bookmark($articleId)) {
            // $articleIdに該当する記事にブックマークを登録する
            $user->bookmark_articles()->attach($articleId);
        }
        // 元のページへ戻る
        return back();
    }
    public function destroy($articleId) {
        // ログイン済みユーザー情報を取得
        $user = \Auth::user();
        // 現在のユーザーに$articleIdに該当する記事がブックマークされている場合
        if ($user->is_bookmark($articleId)) {
            // $articleIdに該当する記事からブックマークを削除する
            $user->bookmark_articles()->detach($articleId);
        }
        // 元のページへ戻る
        return back();
    }
}
