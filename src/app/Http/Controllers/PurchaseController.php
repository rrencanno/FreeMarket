<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\Purchase;
use App\Models\User;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        $product = Product::with('purchase')->findOrFail($item_id);
        $user = Auth::user();

        // shipping_addresses がなければ users テーブルの情報を使う
        $address = $user->shippingAddress ?? (object)[
            'post_code' => $user->post_code,
            'address' => $user->address,
            'building_name' => $user->building_name,
        ];

        return view('purchase', compact('product', 'address'));
    }

    public function store(PurchaseRequest $request, $item_id)
    {
        $product = Product::findOrFail($item_id);
        $user = Auth::user();

        $purchase = new Purchase();
        $purchase->user_id = $user->id;
        $purchase->product_id = $product->id;
        $purchase->shipping_address_id = $user->shipping_address_id;
        $purchase->payment_method = $request->payment_method;
        $purchase->amount = $product->price;
        $purchase->save();

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

    public function updateAddress(AddressRequest $request, $item_id)
    {
        $user = Auth::user();
        $address = $user->shippingAddress;

        $address->post_code = $request->post_code;
        $address->address = $request->address;
        $address->building_name = $request->building_name;
        $address->save();

        return redirect()->route('purchase.show', ['item_id' => $item_id])
                        ->with('success', '住所を更新しました');
    }

    // Stripe機能 //
    public function checkout(Request $request, $item_id)
    {
        $request->validate([
            'payment_method' => 'required|in:コンビニ払い,カード払い',
        ]);

        $product = Product::findOrFail($item_id);

        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentMethod = $request->payment_method;

        // カード払いの場合: Stripe Checkout セッション作成
        if ($paymentMethod === 'カード払い') {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => (int) $product->price,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('purchase.success'),
                'cancel_url' => route('purchase.cancel'),
            ]);

            return redirect($session->url);
        }

        // コンビニ払いの場合：成功画面にリダイレクト（Stripe未対応なためモック処理）
        // return view('purchase.success');
        return redirect()->route('purchase.success')->with('message', 'コンビニ払いでの購入が完了しました（仮）');
    }

    public function success()
    {
        return view('purchase.success');
    }

    public function cancel()
    {
        return view('purchase.cancel');
    }
}
