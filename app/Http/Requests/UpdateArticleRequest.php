<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // // 引用元：「5.記事の詳細と編集」https://newmonz.jp/lesson/laravel-basic/chapter-5
            // // バリデーションチェック(updateアクションに渡された$requestに格納されている値が定義に合っていることを確認する)
            // チェック項目としてtitleが未入力ではないこと、最大文字数は255文字以内であることを定義
            'title' => 'required|max:255',
            // チェック項目としてbodyは未入力ではないことを定義
            'body' => 'required'
        ];
    }
}
