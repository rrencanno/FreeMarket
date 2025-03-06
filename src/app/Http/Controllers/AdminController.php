<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; // Contactモデルをインポート
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // フィルタリング条件
        $query = Contact::query();

        // 🔍 検索フォームの入力があれば処理
    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('email', 'LIKE', "%{$search}%");
        });
    }

    $contacts = $query->paginate(7); // 7件ごとにページネーション
    $categories = Category::all();

    return view('admin.index', compact('contacts', 'categories'));

        // if ($request->filled('name')) {
        //     if ($request->has('exact_match')) {
        //         $query->where('name', $request->name);
        //     } else {
        //         $query->where('name', 'like', '%' . $request->name . '%');
        //     }
        // }

        // if ($request->filled('email')) {
        //     $query->where('email', 'like', '%' . $request->email . '%');
        // }

        // if ($request->filled('gender') && $request->gender !== 'all') {
        //     $query->where('gender', $request->gender);
        // }

        // if ($request->filled('category_id')) {
        //     $query->where('category_id', $request->category_id);
        // }

        // if ($request->filled('date')) {
        //     $query->whereDate('created_at', $request->date);
        // }

        // $contacts = $query->paginate(7);
        // $categories = Category::all();

        // return view('admin.index', compact('contacts', 'categories'));
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('admin.show', compact('contact'));
    }
}
