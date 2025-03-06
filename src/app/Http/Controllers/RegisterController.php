<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // 正しいBladeファイルを指定
    }

    public function register(RegisterRequest $request)
    {
         // ユーザー作成
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // パスワードをハッシュ化
        ]);

        // 作成したユーザーをログイン状態にする
        Auth::login($user);

        return redirect()->route('login.index'); // 登録後のリダイレクト先
        // return view('auth.login');
    }

    // protected function registered(Request $request, $user)
    // {
    //     return redirect()->route('register');
    // }

    // public function showRegistrationForm()
    // {
    //     return view('register'); // ここで表示するBladeファイルを指定
    // }
}
