<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    /**
     * ユーザーとブックマークの一対多の関係
     *
     * 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 記事とブックマークの一対多の関係
     *
     * 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
    */
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
