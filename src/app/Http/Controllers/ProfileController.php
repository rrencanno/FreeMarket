<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('profiles', 'public');
            $user->image_url = $path;
        }

        // ユーザー情報の更新
        $user->name = $request->name;
        $user->post_code = $request->post_code;
        $user->address = $request->address;
        $user->building_name = $request->building_name;
        $user->save();

        // ShippingAddressの更新
        $address = $user->shippingAddress ?? new ShippingAddress();
        $address->user_id = $user->id;
        $address->post_code = $request->post_code;
        $address->address = $request->address;
        $address->building_name = $request->building_name;
        $address->save();

        return redirect()->route('top')->with('success', 'プロフィールを更新しました！');
    }

    // マイページ画面
    public function mypage(Request $request)
    {
        $user = Auth::user();
        $tab = $request->query('tab', 'sell');

        if ($tab === 'buy') {
            $products = $user->purchasedProducts()->paginate(9);
        } else {
            $products = $user->products()->paginate(9);
        }

        return view('mypage', compact('user', 'products', 'tab'));
    }
}
