<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShippingAddressTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 送付先住所を変更すると購入画面に反映される()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // shipping_addresses テーブルに関連レコードを作成
        ShippingAddress::create([
            'user_id' => $user->id,
            'post_code' => '000-0000',
            'address' => '初期住所',
            'building_name' => '初期建物名',
        ]);

        $this->actingAs($user);

        // 送付先住所を登録（または更新）
        $response = $this->patch(route('purchase.address.update', ['item_id' => $product->id]), [
            'post_code' => '123-4567',
            'address' => '東京都新宿区テスト1-2-3',
            'building_name' => 'テストビル101',
        ]);

        $response->assertRedirect(route('purchase.show', ['item_id' => $product->id]));

        // 商品購入画面を開く
        $response = $this->get("/purchase/{$product->id}");

        // 購入画面に住所が表示されていることを確認
        $response->assertSee('123-4567');
        $response->assertSee('東京都新宿区テスト1-2-3');
        $response->assertSee('テストビル101');
    }

    /** @test */
    public function 購入した商品に送付先住所が紐づいて登録される()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // 初期住所を登録
        ShippingAddress::create([
            'user_id' => $user->id,
            'post_code' => '000-0000',
            'address' => '初期住所',
            'building_name' => '初期建物名',
        ]);

        $this->actingAs($user);

        // 送付先住所を登録
        $response = $this->patch(route('purchase.address.update', ['item_id' => $product->id]), [
            'post_code' => '123-4567',
            'address' => '東京都新宿区テスト1-2-3',
            'building_name' => 'テストビル101',
        ]);

        // 商品を購入
        $response = $this->post("/purchase/{$product->id}", [
            'payment_method' => 'カード払い',
        ]);

        $response->assertRedirect('/mypage?tab=buy');

        // 購入情報に住所が含まれているか確認
        $this->assertDatabaseHas('shipping_addresses', [
            'user_id' => $user->id,
            'post_code' => '123-4567',
            'address' => '東京都新宿区テスト1-2-3',
            'building_name' => 'テストビル101',
        ]);
    }
}
