<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookmarkService;

class BookmarkController extends Controller
{
    // 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
    //多対多リレーションを定義したリソースはattach()メソッドで追加、detach()メソッドで削除することができる
    public function store($articleId, BookmarkService $bookmarkService) {
        $bookmarkService->store($articleId);
        // 元のページへ戻る
        return back();
    }

    public function destroy($articleId, BookmarkService $bookmarkService) {
        $bookmarkService->destroy($articleId);
        // 元のページへ戻る
        return back();
    }
}
