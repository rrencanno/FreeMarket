<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // 検索機能
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 価格順ソート
        if ($request->has('sort')) {
            $query->orderBy('price', $request->sort);
        }

        $products = $query->paginate(6);

        return view('index', compact('products'));
    }
}
