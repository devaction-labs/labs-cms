<?php

namespace Database\Seeders;

use App\Models\{Opportunity};
use Illuminate\Database\Seeder;

class OpportunitySeeder extends Seeder
{
    public function run(): void
    {
        if (app()->environment('local')) {
            $opps = [];

            for ($i = 1; $i <= 5; $i++) {
                $opps[] = Opportunity::factory()->make(['customer_id' => rand(1, 3)])->toArray();
            }

            Opportunity::query()->insert($opps);
        }
    }
}
