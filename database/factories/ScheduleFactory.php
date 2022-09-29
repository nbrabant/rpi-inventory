<?php

namespace Database\Factories;

use App\Domain\Schedule\Entities\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScheduleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Schedule::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $typeEnum = ['recette', 'rendezvous', 'planning'];
        return [
            'type_schedule' => $typeEnum[rand(0, 2)],
            'title'         => $this->faker->title,
            'details'       => $this->faker->text(150),
            'start_at'      => $this->faker->dateTime,
            'end_at'        => $this->faker->dateTime,
            'all_day'       => $this->faker->boolean
        ];
    }
}
