<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MyListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function いいねした商品だけが表示される()
    {
        $user = User::factory()->create();
        $likedProduct = Product::factory()->create();
        $notLikedProduct = Product::factory()->create();

        // 「いいね」関係を作成
        $user->favorites()->attach($likedProduct->id);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee($likedProduct->name);
        $response->assertDontSee($notLikedProduct->name);
    }

    /** @test */
    public function 購入済み商品は_sold_と表示される()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        // いいね登録
        $user->favorites()->attach($product->id);

        // 購入登録
        Purchase::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'payment_method' => 'カード払い',
            'amount' => $product->price,
        ]);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee('SOLD');
    }

    /** @test */
    public function 自分が出品した商品は表示されない()
    {
        $user = User::factory()->create();

        $ownProduct = Product::factory()->create(['user_id' => $user->id]);
        $likedProduct = Product::factory()->create();
        $user->favorites()->attach($likedProduct->id);

        $response = $this->actingAs($user)->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertSee($likedProduct->name);
        $response->assertDontSee($ownProduct->name);
    }

    /** @test */
    public function 未認証の場合は何も表示されない()
    {
        $response = $this->get('/?tab=mylist');

        $response->assertStatus(200);
        $response->assertDontSee('<div class="product-card">', false); // 商品カードが表示されないこと
    }
}
