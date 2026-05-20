<x-app-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="row g-4 mb-4">
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-semibold">Total Employees</div>
                            <div class="display-6 fw-bold mb-0">{{ $totalEmployees }}</div>
                        </div>
                        <span class="badge rounded-pill text-bg-primary">Team</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-semibold">Attendance Records</div>
                            <div class="display-6 fw-bold mb-0">{{ $totalAttendanceRecords }}</div>
                        </div>
                        <span class="badge rounded-pill text-bg-secondary">Logs</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-semibold">Present Today</div>
                            <div class="display-6 fw-bold text-success mb-0">{{ $presentToday }}</div>
                        </div>
                        <span class="badge rounded-pill text-bg-success">Live</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <div class="text-muted small fw-semibold">Absent Today</div>
                            <div class="display-6 fw-bold text-danger mb-0">{{ $absentToday }}</div>
                        </div>
                        <span class="badge rounded-pill text-bg-danger">Today</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card table-card">
                <div class="card-header bg-white fw-semibold">Attendance Status Summary</div>
                <div class="card-body">
                    @foreach (\App\Models\Attendance::STATUSES as $status)
                        <div class="d-flex justify-content-between border-bottom py-3">
                            <span>{{ $status }}</span>
                            <span class="fw-bold">{{ $statusCounts[$status] ?? 0 }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card table-card">
                <div class="card-header bg-white fw-semibold">Recent Attendance</div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentAttendances as $attendance)
                                <tr>
                                    <td>{{ $attendance->employee->full_name }}</td>
                                    <td>{{ $attendance->attendance_date->format('M d, Y') }}</td>
                                    <td><span class="badge text-bg-primary">{{ $attendance->attendance_status }}</span></td>
                                    <td>{{ $attendance->check_in_time ?? '-' }}</td>
                                    <td>{{ $attendance->check_out_time ?? '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">No attendance records yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
