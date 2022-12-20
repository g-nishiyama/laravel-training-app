<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // indexメソッドを定義
    public function index()
    {
        // home.blade.phpのビュー表示
        return view('home');
    }
}
