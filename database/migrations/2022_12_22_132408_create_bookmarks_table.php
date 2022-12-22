<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            // idカラムを追加　データ型は符号なしBIGINTを使用した自動増分ID（主キー）
            $table->id();
            // user_idカラムを追加　データ型はBigInt　符号なし整数（マイナスは不可）
            $table->bigInteger('user_id')->unsigned();
            // article_idカラムを追加　データ型はBigInt　符号なし整数（マイナスは不可）
            $table->bigInteger('article_id')->unsigned();
            // created_at、updated_atを追加
            $table->timestamps();

            // user_idカラムを外部キーに設定　usersテーブルのidカラムを参照　削除時は参照しているブックマーク(bookmarks)も一緒に削除する
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // article_idカラムを外部キーに設定　articlesテーブルのidカラムを参照　削除時は参照しているブックマーク(bookmarks)も一緒に削除する
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            // user_id、article_idにユニーク制約（一意制約）を設定
            $table->unique(['user_id', 'article_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
};
