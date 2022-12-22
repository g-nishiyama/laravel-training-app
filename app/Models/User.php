<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Articleとの一対多のリレーションメソッドを定義
     *
     * 引用元：「8.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-8
    */
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * UserクラスからみたBookmarkの関係
     *
     * 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
    */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    /**
     * Userクラスに多対多のリレーションメソッドを定義
     *
     * あるユーザーがブックマークした記事のリソースを操作できるようにする。
     * 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
    */
    public function bookmark_articles()
    {
        /**
         * belongsToManyで多対多のリレーションを定義
         *   第一引数・・・関係の対象となるクラス
         *   第二引数・・・使用するテーブル（中間テーブル）
         *   第三引数・・・自分側のidを保持するカラム
         *   第四引数・・・相手側のidを保持するカラム
         *   自分がブックマークした記事の一覧を取得する場合は下記で取得できる
         *     $user = \Auth::user();
         *     $articles = $user->bookmark_articles()->get();
         * 　引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
         */
        return $this->belongsToMany(Article::class, 'bookmarks', 'user_id', 'article_id');
    }

    /**
     * ブックマークしているかどうか判定するメソッド定義
     *
     * 引用元：「9.記事のブックマーク」https://newmonz.jp/lesson/laravel-basic/chapter-9
     */
    public function is_bookmark($articleId)
    {
        // bookmarksテーブルのarticle_idカラムの値が$atricleIdと一致するレコードが存在する場合はTrueを返す
        return $this->bookmarks()->where('article_id', $articleId)->exists();
    }
}
