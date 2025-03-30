<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.step1');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('register.step2');
    }

    public function create()
    {
        return view('auth.step2');
    }

    public function store(RegisterStep2Request $request)
    {
        DB::transaction(function () use ($request) {
        WeightLog::create([
            'user_id' => Auth::id(),
            'weight' => $request->current_weight,
            'date' => now()->toDateString(),
            'calories' => 0, //デフォルト値
            'exercise_time' => '00:00:00', // 例：デフォルト値を設定
            'exercise_content' => '',
        ]);

        WeightTarget::create([
            'user_id' => Auth::id(),
            'target_weight' => $request->target_weight,
        ]);
    });

        return redirect('/weight_logs');
    }
}
