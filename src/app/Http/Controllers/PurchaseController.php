<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ShippingAddress;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        $product = Product::with('product_images')->findOrFail($item_id);
        $address = Auth::user()->shippingAddress;

        return view('purchase', compact('product', 'address'));
    }

    public function store(Request $request, $item_id)
    {
        $request->validate([
            'payment_method' => 'required|in:コンビニ払い,カード払い',
        ]);

        $product = Product::findOrFail($item_id);
        $user = Auth::user();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->product_id = $product->id;
        $transaction->shipping_address_id = $user->shipping_address_id;
        $transaction->payment_method = $request->payment_method;
        $transaction->amount = $product->price;
        $transaction->save();

        return redirect('/mypage?tab=buy')->with('success', '購入が完了しました');
    }

    //送付先住所変更
    public function editAddress($item_id)
    {
        $address = Auth::user()->shippingAddress;
        return view('purchase_address', [
            'item_id' => $item_id,
            'address' => $address
        ]);
    }

    public function updateAddress(Request $request, $item_id)
    {
        $request->validate([
            'post_code' => 'required|string|max:10',
            'address' => 'required|string|max:255',
            'building_name' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $address = $user->shippingAddress;

        $address->post_code = $request->post_code;
        $address->address = $request->address;
        $address->building_name = $request->building_name;
        $address->save();

        return redirect()->route('purchase.show', ['item_id' => $item_id])
                        ->with('success', '住所を更新しました');
    }
}
