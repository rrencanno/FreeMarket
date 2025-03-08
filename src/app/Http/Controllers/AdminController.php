<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; // Contactモデルをインポート
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        \Log::info($request->all()); // リクエストデータのログ出力
        
        // フィルタリング条件
        $query = Contact::query();

        // 🔍 検索フォームの入力があれば処理
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'LIKE', "%{$search}%")
                ->orWhere('last_name', 'LIKE', "%{$search}%")
                ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$search}%"])
                ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // 🔍 性別フィルター
        if ($request->input('gender') && $request->input('gender') !== 'all') {
            $query->where('gender', $request->input('gender'));
        }

         // 🔍 お問い合わせの種類（category_id）フィルター
        if ($request->input('inquiry_type') && $request->input('inquiry_type') !== 'all') {
            $query->where('inquiry_type', $request->input('inquiry_type'));
        }

        if ($date = $request->input('date')) {
            $query->whereDate('created_at', $date);
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

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.index')->with('success', '削除しました');
    }
}
