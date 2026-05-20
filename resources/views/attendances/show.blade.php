<x-app-layout>
    <x-slot:title>Attendance Details</x-slot:title>

    <div class="card table-card">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="text-muted small">Employee</div>
                    <div class="fw-semibold">{{ $attendance->employee->full_name }}</div>
                </div>
                <div class="col-md-6">
                    <div class="text-muted small">Date</div>
                    <div class="fw-semibold">{{ $attendance->attendance_date->format('M d, Y') }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted small">Status</div>
                    <div class="fw-semibold">{{ $attendance->attendance_status }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted small">Check In</div>
                    <div class="fw-semibold">{{ $attendance->check_in_time ?? '-' }}</div>
                </div>
                <div class="col-md-4">
                    <div class="text-muted small">Check Out</div>
                    <div class="fw-semibold">{{ $attendance->check_out_time ?? '-' }}</div>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('attendances.edit', $attendance) }}" class="btn btn-primary">Edit Record</a>
                <a href="{{ route('attendances.index') }}" class="btn btn-light">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>
