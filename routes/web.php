<?php

use Illuminate\Support\Facades\Route;
// ArticleControllerクラスをインポート
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //"hello.blade.php"を渡して画面表示
    return view('hello');
});

// URL(/articles)にGETリクエストでアクセスした際に、ArticleControllerクラスのindexメソッドを実行。この定義に"articles.index"と名前設定
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// URL(/articles/create)にGETリクエストでアクセスした際に、ArticleControllerクラスのcreateメソッドを実行。この定義に"articles.create"と名前設定
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// URL(/articles)にPOSTリクエストでアクセスした際に、ArticleControllerクラスのstoreメソッドを実行。この定義に"articles.store"と名前設定
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
