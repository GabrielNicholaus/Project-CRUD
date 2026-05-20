<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckInAttendanceRequest;
use App\Http\Requests\CheckOutAttendanceRequest;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Employee;
use App\Services\ActivityLogger;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function __construct(private readonly ActivityLogger $activityLogger)
    {
    }

    public function index()
    {
        $employees = Employee::orderBy('full_name')->get();
        $attendances = Attendance::query()
            ->with('employee')
            ->when(request('search'), function ($query, $search) {
                $query->whereHas('employee', fn ($employeeQuery) => $employeeQuery
                    ->where('employee_id', 'like', "%{$search}%")
                    ->orWhere('full_name', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%"));
            })
            ->when(request('date'), fn ($query, $date) => $query->whereDate('attendance_date', $date))
            ->when(request('employee_id'), fn ($query, $employeeId) => $query->where('employee_id', $employeeId))
            ->latest('attendance_date')
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('attendances.index', compact('attendances', 'employees'));
    }

    public function create()
    {
        $employees = Employee::orderBy('full_name')->get();
        $statuses = Attendance::STATUSES;

        return view('attendances.create', compact('employees', 'statuses'));
    }

    public function store(StoreAttendanceRequest $request)
    {
        $attendance = Attendance::create($request->validated());

        $this->activityLogger->log('attendance create', 'Created attendance record.', $attendance);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance record created successfully.');
    }

    public function show(Attendance $attendance)
    {
        $attendance->load('employee');

        return view('attendances.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::orderBy('full_name')->get();
        $statuses = Attendance::STATUSES;

        return view('attendances.edit', compact('attendance', 'employees', 'statuses'));
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->validated());

        $this->activityLogger->log('attendance update', 'Updated attendance record.', $attendance);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance record updated successfully.');
    }

    public function destroy(Attendance $attendance)
    {
        $this->activityLogger->log('attendance delete', 'Deleted attendance record.', $attendance);

        $attendance->delete();

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Attendance record deleted successfully.');
    }

    public function checkIn(CheckInAttendanceRequest $request)
    {
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::firstOrCreate(
            [
                'employee_id' => $request->validated('employee_id'),
                'attendance_date' => $today,
            ],
            [
                'check_in_time' => Carbon::now()->format('H:i'),
                'attendance_status' => 'Present',
            ],
        );

        if (! $attendance->wasRecentlyCreated && ! $attendance->check_in_time) {
            $attendance->update([
                'check_in_time' => Carbon::now()->format('H:i'),
                'attendance_status' => 'Present',
            ]);
        }

        $this->activityLogger->log('attendance check in', 'Recorded attendance check in.', $attendance);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Check in recorded successfully.');
    }

    public function checkOut(CheckOutAttendanceRequest $request)
    {
        $attendance = Attendance::findOrFail($request->validated('attendance_id'));

        $attendance->update([
            'check_out_time' => Carbon::now()->format('H:i'),
        ]);

        $this->activityLogger->log('attendance check out', 'Recorded attendance check out.', $attendance);

        return redirect()
            ->route('attendances.index')
            ->with('success', 'Check out recorded successfully.');
    }
}
