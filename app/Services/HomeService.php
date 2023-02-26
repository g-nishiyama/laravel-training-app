<?php

namespace App\Services;

class HomeService
{
    public function index()
    {
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // 自分の記事一覧を投稿日降順でソートし、ページネーションで1ページ10件で区切ったデータを取得
        $articles = \Auth::user()->articles()->orderBy('created_at', 'desc')->paginate(10);
        // 取得したコレクション型の$articlesをキーarticlesとして連想配列に格納
        $data = [
            'articles' => $articles,
        ];
        return $data;
    }

}