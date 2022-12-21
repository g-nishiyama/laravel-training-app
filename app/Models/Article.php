<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * Userとの多対一のリレーションメソッドを定義
     *
     * 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
