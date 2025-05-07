<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProfileEditTest extends TestCase
{
    use RefreshDatabase;

    public function test_プロフィール編集ページに初期値が表示される()
    {
        Storage::fake('public');

        // ユーザー作成（ダミー画像あり）
        $user = User::factory()->create([
            'name' => 'テスト太郎',
            'image_url' => 'profiles/sample.jpg',
            'post_code' => '123-4567',
            'address' => '東京都渋谷区1-1-1',
        ]);

        // 仮想ストレージに画像を保存（必要であれば）
        // Storage::disk('public')->put('profiles/sample.jpg', UploadedFile::fake()->image('sample.jpg'));

        // ログインしてプロフィール編集ページにアクセス
        $response = $this->actingAs($user)->get(route('mypage.profile'));

        // ステータス確認
        $response->assertStatus(200);

        // 各初期値が表示されていることを確認
        $response->assertSee('テスト太郎');
        $response->assertSee('123-4567');
        $response->assertSee('東京都渋谷区1-1-1');
        $response->assertSee('profiles/sample.jpg');
    }
}
