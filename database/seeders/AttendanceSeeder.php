<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            for ($day = 0; $day < 10; $day++) {
                $date = Carbon::today()->subDays($day)->toDateString();
                $status = fake()->randomElement(Attendance::STATUSES);
                $checkIn = $status === 'Present' ? fake()->time('H:i') : null;

                Attendance::create([
                    'employee_id' => $employee->id,
                    'attendance_date' => $date,
                    'check_in_time' => $checkIn,
                    'check_out_time' => $checkIn ? fake()->time('H:i') : null,
                    'attendance_status' => $status,
                ]);
            }
        }
    }
}
