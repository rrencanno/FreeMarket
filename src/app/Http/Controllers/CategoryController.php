<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(7); //7件ごとのページネーション

        return view('category', compact('categories'));
    }

    public function search(Request $request)
    {
        $query = Category::query();

        // 名前検索（部分一致・完全一致）
        if ($request->filled('name')) {
            if ($request->input('match') === 'exact') {
                $query->where('name', $request->input('name'));
            } else {
                $query->where('name', 'like', '%' . $request->input('name') . '%');
            }
        }

        // メール検索（部分一致・完全一致）
        if ($request->filled('email')) {
            if ($request->input('match') === 'exact') {
                $query->where('email', $request->input('email'));
            } else {
                $query->where('email', 'like', '%' . $request->input('email') . '%');
            }
        }

        // 性別検索
        if ($request->filled('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }

        // お問い合わせ種類検索
        if ($request->filled('inquiry_type')) {
            $query->where('inquiry_type', $request->input('inquiry_type'));
        }

        // 日付検索
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->input('date'));
        }

        $categories = $query->paginate(7);

        return view('category', compact('categories'));
    }
}
