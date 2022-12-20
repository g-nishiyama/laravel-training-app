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

// resource()メソッドで定義したルーティングをリソースルートと呼ぶ。リソースをCRUDするつの基本ルーティングの省略形で、これを記載することで基本ルーティングが自動的に作成される
// 特定のメソッドだけを除外する場合は下記のように第二引数へexceptを使って記述することで除外できる
//      Route::resource('/articles', ArticleController::class, ['except' => ['show']]);
// 特定のメソッドだけを指定して設定する場合は下記のように第二引数へonlyを使って記述することで指定できる
//    Route::resource('/articles', ArticleController::class, ['only' => ['index', 'store', 'destroy']]);
Route::resource('/articles', ArticleController::class);


// // URL(/articles)にGETリクエストでアクセスした際に、ArticleControllerクラスのindexメソッドを実行。この定義に"articles.index"と名前設定
// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

// // URL(/articles/create)にGETリクエストでアクセスした際に、ArticleControllerクラスのcreateメソッドを実行。この定義に"articles.create"と名前設定
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');

// // URL(/articles)にPOSTリクエストでアクセスした際に、ArticleControllerクラスのstoreメソッドを実行。この定義に"articles.store"と名前設定
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

// // URL(/articles/{article})の{article}部分に記事の主キーであるidを添えてGETリクエストでアクセスした際に、ArticleControllerクラスのshowメソッドを実行。この定義に"articles.show"と名前設定
// Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

// // URL(/articles/{article}/edit)の{article}部分に記事の主キーであるidを添えてGETリクエストでアクセスした際に、ArticleControllerクラスのeditメソッドを実行。この定義に"articles.edit"と名前設定
// Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');

// // URL(/articles/{article})の{article}部分に記事の主キーであるidを添えてPOSTリクエスト(実際はpatch)でアクセスした際に、ArticleControllerクラスのupdateメソッドを実行。この定義に"articles.update"と名前設定
// Route::patch('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');

// // URL(/articles/{article})の{article}部分に記事の主キーであるidを添えてPOSTリクエスト(実際はdelete)でアクセスした際に、ArticleControllerクラスのdestroyメソッドを実行。この定義に"articles.destroy"と名前設定
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');