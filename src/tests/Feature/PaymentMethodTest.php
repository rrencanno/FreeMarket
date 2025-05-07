<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentMethodTest extends TestCase
{
    use RefreshDatabase;

    public function test_支払い方法選択画面で選択が即時反映される()
    {
        // ユーザーと商品を作成
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // ユーザーとしてログイン
        $response = $this->actingAs($user)
            ->get("/purchase/{$product->id}");

        // ページが表示される
        $response->assertStatus(200);

        // プルダウンに「コンビニ払い」「カード払い」が表示されている
        $response->assertSee('コンビニ払い');
        $response->assertSee('カード払い');

        // フォーム送信シミュレーション（支払い方法を変更して反映確認）
        $postResponse = $this->post("/purchase/{$product->id}", [
            'payment_method' => 'カード払い',
        ]);

        // 変更が反映されたかを確認（次の画面で選択が維持されているなど）
        $postResponse->assertRedirect('/mypage?tab=buy');
        // データベースやセッションの状態も確認したい場合はここに追加
    }
}
