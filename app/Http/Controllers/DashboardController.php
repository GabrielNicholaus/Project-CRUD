<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $today = Carbon::today();

        $totalEmployees = Employee::count();
        $totalAttendanceRecords = Attendance::count();
        $presentToday = Attendance::whereDate('attendance_date', $today)
            ->where('attendance_status', 'Present')
            ->count();
        $recordedToday = Attendance::whereDate('attendance_date', $today)->count();
        $absentToday = max($totalEmployees - $recordedToday, 0);

        $statusCounts = Attendance::query()
            ->selectRaw('attendance_status, count(*) as total')
            ->groupBy('attendance_status')
            ->pluck('total', 'attendance_status');

        $recentAttendances = Attendance::with('employee')
            ->latest('attendance_date')
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard', compact(
            'totalEmployees',
            'totalAttendanceRecords',
            'presentToday',
            'absentToday',
            'statusCounts',
            'recentAttendances',
        ));
    }
}
