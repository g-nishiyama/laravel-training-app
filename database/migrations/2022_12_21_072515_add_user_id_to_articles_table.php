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
        // Schemaファサードのtableメソッドでarticlesテーブルにクロージャ内の内容を反映させる
        Schema::table('articles', function (Blueprint $table) {
            // user_idカラムを追加　データ型はBigInt　符号なし整数（マイナスは不可）
            $table->bigInteger('user_id')->unsigned();
            // user_idカラムを外部キーに設定　usersテーブルのidカラムを参照　削除時は参照している記事(article)も一緒に削除する
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    // ロールバックした場合に実行される
    public function down()
    {
        // Schemaファサードのtableメソッドでarticlesテーブルにクロージャ内の内容を反映させる
        Schema::table('articles', function (Blueprint $table) {
            // 外部キー制約を削除（外部キー制約がついているカラムは削除できないため）
            $table->dropForeign('articles_user_id_foreign');
            // user_idカラムを削除
            $table->dropColumn('user_id');
        });
    }
};
