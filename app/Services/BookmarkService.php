<?php

namespace App\Services;

class BookmarkService
{
    public function store($articleId)
    {
        // ログイン済みユーザー情報を取得
        $user = \Auth::user();
        // 現在のユーザーに$articleIdに該当する記事がブックマークされていない場合
        if (!$user->is_bookmark($articleId)) {
            // $articleIdに該当する記事にブックマークを登録する
            $user->bookmark_articles()->attach($articleId);
        }
    }

    public function destroy($articleId)
    {
        // ログイン済みユーザー情報を取得
        $user = \Auth::user();
        // 現在のユーザーに$articleIdに該当する記事がブックマークされている場合
        if ($user->is_bookmark($articleId)) {
            // $articleIdに該当する記事からブックマークを削除する
            $user->bookmark_articles()->detach($articleId);
        }
    }
}