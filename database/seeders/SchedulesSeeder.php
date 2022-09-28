<?php

namespace Database\Seeders;

use App\Domain\Schedule\Entities\Schedule;
use Illuminate\Database\Seeder;

class SchedulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Schedule::class, 200)->create();
    }
}
