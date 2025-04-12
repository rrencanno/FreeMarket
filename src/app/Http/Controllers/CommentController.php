<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Product $product)
    {
        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'コメントを投稿しました！');
    }
}
