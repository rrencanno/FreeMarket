<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $prefix = $this->faker->randomElement(['090', '080', '070']);

        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->safeEmail(),
            'tell' => sprintf(
                "%s-%04d-%04d",
                $prefix,
                $this->faker->numberBetween(1000, 9999),
                $this->faker->numberBetween(1000, 9999)
            ),
            'address' => $this->faker->address,
            'building' => $this->faker->randomElement([
                'サンシャインマンション',
                'グリーンハイツ',
                'レジデンス青山',
                'シティタワー東京',
                'パークハウス横浜',
                'メゾン・ド・銀座',
                'ロイヤルコート新宿',
                'ラ・フォーレ池袋',
                'アーバンステージ大阪',
                'プラチナレジデンス福岡',
                'ウィングヒルズ札幌',
                'サンライズタワー仙台'
            ]) . $this->faker->numberBetween(101, 1503) . '号室',
            'detail' => $this->faker->realText(100, 2)
        ];
    }
}
