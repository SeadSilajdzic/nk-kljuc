<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Dashboard\Post\Post;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {
        $latestPost = Post::select(['id', 'title', 'subtitle', 'short_description', 'image', 'description', 'created_at'])->where('status', 1)->orderByDesc('created_at')->first();
        return view('index', [
            'latest_post' => $latestPost
        ]);
    }
}
