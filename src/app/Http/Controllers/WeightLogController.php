<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\UpdateWeightLogRequest;
use App\Http\Requests\TargetWeightRequest;
use App\Http\Requests\StoreWeightLogRequest;

class WeightLogController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // 目標体重取得
        $targetWeight = WeightTarget::where('user_id', $user->id)->value('target_weight');

        // 最新の体重取得
        $latestWeight = WeightLog::where('user_id', $user->id)->latest('date')->value('weight');

        // 目標までの差分計算
        $weightDifference = $latestWeight - $targetWeight;

        // 検索機能
        $query = WeightLog::where('user_id', $user->id);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        // ページネーション（8件ごと）
        $weightLogs = $query->orderBy('date', 'desc')->paginate(8);

        return view('index', compact('targetWeight', 'latestWeight', 'weightDifference', 'weightLogs'));
    }

    public function store(StoreWeightLogRequest $request)
    {
        // 認証ユーザーを取得
        $user = Auth::user();

        // 体重ログを作成
        WeightLog::create([
            'user_id' => $user->id,
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index')
        ->with('success', '体重ログを追加しました')
        ->with('showModal', true);
    }

    // 編集画面表示
    public function edit($id)
    {
        $weightLog = WeightLog::findOrFail($id);
        return view('edit', compact('weightLog'));
    }

    // 更新処理
    public function update(UpdateWeightLogRequest $request, $id)
    {
        $weightLog = WeightLog::findOrFail($id);
        $weightLog->update($request->validated());

        return redirect()->route('weight_logs.index')->with('success', '更新しました');
    }

    // 削除処理
    public function destroy($id)
    {
        WeightLog::findOrFail($id)->delete();
        return redirect()->route('weight_logs.index')->with('success', '削除しました');
    }

    public function editTargetWeight()
    {
        $user = Auth::user();
        $targetWeight = WeightTarget::where('user_id', $user->id)->first();

        return view('target_setting', compact('targetWeight'));
    }

    public function updateTargetWeight(TargetWeightRequest $request)
    {
        $user = Auth::user();
        $targetWeight = WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました');
    }
}

