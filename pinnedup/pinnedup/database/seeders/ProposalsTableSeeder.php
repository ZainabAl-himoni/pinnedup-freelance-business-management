<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proposal;
use App\Models\Lead;
use Faker\Factory as Faker;
use Carbon\Carbon;

class ProposalsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // (Optional) Create some leads if you have none:
        // Lead::factory()->count(5)->create();
        // or do a simple loop if you don't have a factory:
        // for ($i = 0; $i < 5; $i++) {
        //     Lead::create([
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         // add other Lead fields as needed
        //     ]);
        // }

        // Make sure at least one lead exists:
        if (Lead::count() === 0) {
            $this->command->warn('No leads found! Creating one dummy lead...');
            Lead::create([
                'name'  => 'Dummy Lead',
                'email' => 'dummy@example.com',
            ]);
        }

        // Now seed proposals
        for ($i = 0; $i < 10; $i++) {
            $price    = $faker->randomFloat(2, 100, 2000);   // random price between 100 and 2000
            $discount = $faker->randomFloat(2, 0, 30);      // random discount up to 30%
            $features = [];

            // Create a random list of features (3-5 items)
            for ($j = 0; $j < mt_rand(3, 5); $j++) {
                $features[] = [
                    'feature' => $faker->sentence(4), // e.g. "Responsive design layout"
                ];
            }

            Proposal::create([
                'title'       => $faker->words(3, true), // e.g. "New Website Project"
                'status'      => $faker->randomElement(['pending', 'accepted', 'rejected']),
                'description' => $faker->sentence(10),
                'lead_id'     => Lead::inRandomOrder()->value('id'), // pick a random existing lead
                'features'    => $features, // stored as JSON if your column is JSON
                'discount'    => $discount,
                'price'       => $price,
                // total_price = price minus discount percentage
                'total_price' => $price - (($price * $discount) / 100),
                'budget'      => $faker->randomFloat(2, 500, 5000),
                'start_date'  => Carbon::now()->addDays($faker->numberBetween(1, 30)),
                'deadline'    => Carbon::now()->addDays($faker->numberBetween(31, 60)),
            ]);
        }
    }
}
