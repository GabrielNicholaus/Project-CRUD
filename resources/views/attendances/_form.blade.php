@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Employee</label>
        <select name="employee_id" class="form-select" required>
            <option value="">Select employee</option>
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" @selected(old('employee_id', $attendance->employee_id ?? '') == $employee->id)>
                    {{ $employee->employee_id }} - {{ $employee->full_name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Attendance Date</label>
        <input type="date" name="attendance_date" class="form-control" value="{{ old('attendance_date', isset($attendance) ? $attendance->attendance_date->format('Y-m-d') : now()->format('Y-m-d')) }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Check In Time</label>
        <input type="time" name="check_in_time" class="form-control" value="{{ old('check_in_time', $attendance->check_in_time ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Check Out Time</label>
        <input type="time" name="check_out_time" class="form-control" value="{{ old('check_out_time', $attendance->check_out_time ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="attendance_status" class="form-select" required>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" @selected(old('attendance_status', $attendance->attendance_status ?? 'Present') === $status)>{{ $status }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('attendances.index') }}" class="btn btn-light">Cancel</a>
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
</div>
