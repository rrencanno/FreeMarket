<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WeightTarget;
use App\Models\User;

class WeightTargetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WeightTarget::create([
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'target_weight' => 65.0,
        ]);
    }
}
