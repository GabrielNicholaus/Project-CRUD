<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departments = ['Engineering', 'Human Resources', 'Finance', 'Marketing', 'Operations'];

        return [
            'employee_id' => 'EMP-'.$this->faker->unique()->numberBetween(1000, 9999),
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'department' => $this->faker->randomElement($departments),
            'position' => $this->faker->jobTitle(),
            'join_date' => $this->faker->dateTimeBetween('-3 years', 'now')->format('Y-m-d'),
            'profile_photo' => null,
        ];
    }
}
