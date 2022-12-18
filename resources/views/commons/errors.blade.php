{{--  引用元：「4.記事の投稿」https://newmonz.jp/lesson/laravel-basic/chapter-4  --}}
{{--  @ifディレクティブ　$errorsにエラーメッセージがあるかどうかチェックを行う
      $errorsにはバリデーションエラーとなった際にエラーメッセージが保存されている
      $errorsはコレクション型のため、配列を便利に扱えるメソッドが用意されている（any()、all()など）
--}}
@if ($errors->any())
    <ul class="alert">
        {{--  $errorsに保存されているエラーメッセージを１つずつ引数の変数$errorに代入して繰り返し処理を行う  --}}
        @foreach ($errors->all() as $error)
            {{--  変数$errorに入っているエラーメッセージを表示  --}}
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif