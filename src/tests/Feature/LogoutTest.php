<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ログアウトができる()
    {
        // ユーザーを作成しログイン
        $user = User::factory()->create([
            'email' => 'test@example.com',
        ]);

        $this->actingAs($user);

        // ログアウト処理
        $response = $this->post('/logout');

        $response->assertRedirect('/login'); // 適宜変更
        $this->assertGuest();
    }
}
