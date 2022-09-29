<?php

namespace Database\Seeders;

use Database\Factories\ScheduleFactory;
use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ScheduleFactory::new([])->count(200)->create();
    }
}
