<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'recommend'); // "recommend" (おすすめ) or "mylist" (マイリスト)
        $search = $request->query('search');

        if ($tab === 'mylist') {
            $user = Auth::user();
            $query = Product::whereHas('favorites', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        } else {
            $query = Product::query();
        }

        if ($search) {
            $query->where('name', 'LIKE', "%{$search}%");
        }

        $products = $query->paginate(9);

        return view('top', compact('products', 'tab', 'search'));
    }

    // 商品詳細画面
    public function show($id)
    {
        $product = Product::with(['favorites', 'comments.user', 'categories'])
            ->findOrFail($id);

        return view('item_show', compact('product'));
    }

    // 出品画面
    public function create()
    {
        return view('sell');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'description' => 'required|string|max:1000',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:良好,目立った傷や汚れなし,やや傷や汚れあり,状態が悪い',
        ]);

        $product->image = $request->file('image_url')->store('products', 'public');

        Product::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'condition' => $request->condition,
            'image' => $path,
        ]);

        return redirect()->route('top')->with('success', '商品を出品しました！');
    }
}
