<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\User;
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
        return [
            'schedule_date' => $this->faker->dateTime,
            'user_id' => self::factoryForModel(User::class),
            'employee_id' => self::factoryForModel(Employee::class),
            'service_id' => self::factoryForModel(Service::class)
        ];
    }
}
