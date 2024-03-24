<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Faker\Factory as Faker;

class GenerateUsers extends Command
{
    protected $signature = 'debug:genUsers';
    protected $description = 'Create users with random names.';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $count = $this->ask('Amount of users to create:');
        $faker = Faker::create();

        for ($i = 0; $i < $count; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('9834c7t9387t938x6ty7938tyz8937rty39284zj6a874r6nht39482xr7yxj93486ytr938ty8z93rtx3897rt6y4398rtxg43b8rx96743y98rf43xxfgyx9348ryfx8473uryhf43xy87c3yg8furbe3bf9u834ur48yfj97iur3tyfe76t'),
            ]);
        }

        $this->info("Successfully created {$count} users.");
    }
}