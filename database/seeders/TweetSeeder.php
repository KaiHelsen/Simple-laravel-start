<?php

namespace Database\Seeders;

use App\Models\Tweet;
use Illuminate\Database\Seeder;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tweet::factory()
            ->count(6)
            ->create();

            //        $tweets= Tweet::factory()->has(Tweet::factorY()->count(3))->create();
    }
}
