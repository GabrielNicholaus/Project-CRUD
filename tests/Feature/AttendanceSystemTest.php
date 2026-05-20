<?php

namespace Tests\Feature;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AttendanceSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_statistics(): void
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create();
        Attendance::factory()->create([
            'employee_id' => $employee->id,
            'attendance_date' => now()->toDateString(),
            'attendance_status' => 'Present',
        ]);

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Total Employees')
            ->assertSee('Present Today');
    }

    public function test_employee_can_be_created_with_profile_photo(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('employees.store'), [
            'employee_id' => 'EMP-9001',
            'full_name' => 'Alya Putri',
            'email' => 'alya@example.com',
            'phone_number' => '08123456789',
            'department' => 'Engineering',
            'position' => 'Backend Developer',
            'join_date' => '2026-05-20',
            'profile_photo' => UploadedFile::fake()->image('alya.jpg'),
        ]);

        $response->assertRedirect(route('employees.index'));
        $this->assertDatabaseHas('employees', ['employee_id' => 'EMP-9001']);
        $this->assertDatabaseHas('activity_logs', ['action' => 'create employee']);

        $employee = Employee::firstWhere('employee_id', 'EMP-9001');
        Storage::disk('public')->assertExists($employee->profile_photo);
    }

    public function test_employee_validation_rejects_invalid_email(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->post(route('employees.store'), [
                'employee_id' => 'EMP-9002',
                'full_name' => 'Invalid Email',
                'email' => 'not-an-email',
                'department' => 'Finance',
                'position' => 'Analyst',
                'join_date' => '2026-05-20',
            ])
            ->assertSessionHasErrors('email');
    }

    public function test_attendance_record_can_be_created_and_checked_out(): void
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create();

        $this->actingAs($user)
            ->post(route('attendances.store'), [
                'employee_id' => $employee->id,
                'attendance_date' => '2026-05-20',
                'check_in_time' => '08:00',
                'attendance_status' => 'Present',
            ])
            ->assertRedirect(route('attendances.index'));

        $attendance = Attendance::first();

        $this->actingAs($user)
            ->post(route('attendances.check-out'), [
                'attendance_id' => $attendance->id,
            ])
            ->assertRedirect(route('attendances.index'));

        $this->assertNotNull($attendance->fresh()->check_out_time);
        $this->assertDatabaseHas('activity_logs', ['action' => 'attendance check out']);
    }

    public function test_attendance_history_can_be_filtered(): void
    {
        $user = User::factory()->create();
        $employee = Employee::factory()->create(['full_name' => 'Rafi Hasan']);
        Attendance::factory()->create([
            'employee_id' => $employee->id,
            'attendance_date' => '2026-05-20',
        ]);

        $this->actingAs($user)
            ->get(route('attendances.index', [
                'employee_id' => $employee->id,
                'date' => '2026-05-20',
            ]))
            ->assertOk()
            ->assertSee('Rafi Hasan');
    }
}
