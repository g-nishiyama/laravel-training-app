<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        // 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
        // 自分の記事一覧を投稿日降順で取得
        $articles = \Auth::user()->articles()->orderBy('created_at', 'desc')->get();
        // 取得したコレクション型の$articlesをキーarticlesとして連想配列に格納
        $data = [
            'articles' => $articles,
        ];
        // viewのhomeに連想配列を渡す
        return view('home', $data);
    }
}
