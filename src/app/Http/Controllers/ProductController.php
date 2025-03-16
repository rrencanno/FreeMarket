<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Season;

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

    public function register()
    {
        $seasons = Season::all(); // 季節の一覧を取得
        return view('register', compact('seasons'));
    }

    public function store(ProductRequest $request)
    {
        // 画像を storage/app/public/products に保存
        $imagePath = $request->file('image')->store('products', 'public');

        // 商品情報を保存
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        // 中間テーブルに保存
        if ($request->has('seasons')) {
            $product->seasons()->attach($request->seasons);
        }

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    public function show($id) {
        $product = Product::with('seasons')->findOrFail($id);
        $seasons = Season::all();
        return view('show', compact('product', 'seasons'));
    }

    public function update(UpdateProductRequest $request, $id) {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        // 季節の更新
        $product->seasons()->sync($request->seasons);

        // 画像アップロード
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();
        return redirect('/products');
    }

    public function destroy($id) {
        Product::findOrFail($id)->delete();
        return redirect('/products');
    }
}

// public function show(Product $product)
    // {
    //     $seasons = Season::all();
    //     return view('show', compact('product', 'seasons'));
    // }

    // public function update(ProductRequest $request, Product $product)
    // {
    //     $product->name = $request->name;
    //     $product->price = $request->price;
    //     $product->description = $request->description;

    //     if ($request->hasFile('image')) {
    //         if ($product->image) {
    //             Storage::delete('public/' . $product->image);
    //         }
    //         $imagePath = $request->file('image')->store('products', 'public');
    //         $product->image = str_replace('public/', '', $imagePath);
    //     } else {
    //         $product->image = '';
    //     }

    //     $product->save();

    //     $product->seasons()->sync($request->season);

    //     return redirect()->route('products.index');
    // }

    // public function destroy(Product $product)
    // {
    //     if ($product->image) {
    //         Storage::delete('public/' . $product->image);
    //     }
    //     $product->delete();
    //     return redirect()->route('products.index');
    // }