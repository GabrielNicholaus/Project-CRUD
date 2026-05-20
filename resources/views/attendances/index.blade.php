<x-app-layout>
    <x-slot:title>Attendance</x-slot:title>

    <div class="row g-4 mb-4">
        <div class="col-lg-5">
            <div class="card table-card">
                <div class="card-header bg-white fw-semibold">Quick Check In</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('attendances.check-in') }}" class="row g-2">
                        @csrf
                        <div class="col-sm-8">
                            <select name="employee_id" class="form-select" required>
                                <option value="">Select employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->employee_id }} - {{ $employee->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-4 d-grid">
                            <button class="btn btn-success">Check In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card table-card">
                <div class="card-header bg-white fw-semibold">Filters</div>
                <div class="card-body">
                    <form method="GET" action="{{ route('attendances.index') }}" class="row g-2">
                        <div class="col-md-4">
                            <input type="search" name="search" class="form-control" placeholder="Search employee" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                        </div>
                        <div class="col-md-3">
                            <select name="employee_id" class="form-select">
                                <option value="">All employees</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" @selected(request('employee_id') == $employee->id)>{{ $employee->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-grid">
                            <button class="btn btn-outline-primary">Apply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card table-card">
        <div class="card-header bg-white border-0 p-4 pb-0">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <h2 class="h5 mb-1">Attendance History</h2>
                    <p class="text-muted mb-0">Track check-ins, check-outs, and daily attendance status.</p>
                </div>
                <a href="{{ route('attendances.create') }}" class="btn btn-primary">Add Record</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->employee->full_name }}</td>
                                <td>{{ $attendance->attendance_date->format('M d, Y') }}</td>
                                <td><span class="badge text-bg-primary">{{ $attendance->attendance_status }}</span></td>
                                <td>{{ $attendance->check_in_time ?? '-' }}</td>
                                <td>{{ $attendance->check_out_time ?? '-' }}</td>
                                <td class="text-end">
                                    @if (! $attendance->check_out_time && $attendance->attendance_status === 'Present')
                                        <form class="d-inline" method="POST" action="{{ route('attendances.check-out') }}">
                                            @csrf
                                            <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                            <button class="btn btn-sm btn-outline-success">Check Out</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('attendances.show', $attendance) }}" class="btn btn-sm btn-light">View</a>
                                    <a href="{{ route('attendances.edit', $attendance) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form class="d-inline" method="POST" action="{{ route('attendances.destroy', $attendance) }}" onsubmit="return confirm('Delete this attendance record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No attendance records found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $attendances->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
