<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(Attendance::STATUSES);
        $checkIn = $status === 'Present' ? $this->faker->time('H:i') : null;

        return [
            'employee_id' => Employee::factory(),
            'attendance_date' => $this->faker->dateTimeBetween('-30 days', 'now')->format('Y-m-d'),
            'check_in_time' => $checkIn,
            'check_out_time' => $checkIn ? $this->faker->time('H:i') : null,
            'attendance_status' => $status,
        ];
    }
}
