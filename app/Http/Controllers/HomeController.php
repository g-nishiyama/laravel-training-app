<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

use App\Services\HomeService;

class HomeController extends Controller
{
    public function index(HomeService $homeService)
    {
        $data = $homeService->index();
        // viewのhomeに連想配列を渡す
        return view('home', $data);
    }
}
