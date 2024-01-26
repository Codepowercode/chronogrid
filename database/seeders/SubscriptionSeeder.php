<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscription::create([
            'name' => 'Free',
            'year' => '1',
            'price' => '0',
        ]);
        Subscription::create([
            'year' => '2',
            'name'=> 'Business',
            'price' => '200',
        ]);
        Subscription::create([
            'year' => '3',
            'name'=> 'Pro',
            'price' => '300',
        ]);
    }
}
