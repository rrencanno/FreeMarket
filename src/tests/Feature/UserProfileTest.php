<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function プロフィールページでユーザー情報と商品一覧が表示される()
    {
        Storage::fake('public');

        // ユーザー作成
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'image_url' => 'profiles/test.jpg',
        ]);

        // プロフィール画像をダミーで保存
        // Storage::disk('public')->put('profiles/test.jpg', UploadedFile::fake()->image('test.jpg'));

        // 出品商品を3件作成
        $products = Product::factory()->count(3)->create([
            'user_id' => $user->id,
        ]);

        // 購入商品（purchasesテーブル）を2件作成
        $purchases = Purchase::factory()->count(2)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/mypage?tab=sell');

        // ステータス確認
        $response->assertStatus(200);

        // ユーザー名と画像パスが表示されていることを確認
        $response->assertSee('テストユーザー');
        $response->assertSee('profiles/test.jpg');

        // 出品した商品が表示されていることを確認
        foreach ($products as $product) {
            $response->assertSee($product->name);
        }


        $response = $this->actingAs($user)->get('/mypage?tab=buy');

        // 購入した商品IDが表示されていることを確認（必要に応じて商品名へ変更）
        foreach ($purchases as $purchase) {
            $response->assertSee((string) $purchase->id);
        }
    }
}
