<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->lastName,
            'company_id' => self::factoryForModel(Company::class),
            'user_id' => self::factoryForModel(User::class),

        ];
    }
}
