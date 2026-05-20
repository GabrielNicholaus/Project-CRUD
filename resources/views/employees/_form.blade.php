@csrf

<div class="row g-4">
    <div class="col-md-6">
        <label class="form-label fw-semibold">Employee ID</label>
        <input type="text" name="employee_id" class="form-control" value="{{ old('employee_id', $employee->employee_id ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Full Name</label>
        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $employee->full_name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Phone Number</label>
        <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number', $employee->phone_number ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Department</label>
        <input type="text" name="department" class="form-control" value="{{ old('department', $employee->department ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Position</label>
        <input type="text" name="position" class="form-control" value="{{ old('position', $employee->position ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Join Date</label>
        <input type="date" name="join_date" class="form-control" value="{{ old('join_date', isset($employee) ? $employee->join_date->format('Y-m-d') : '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold">Profile Photo</label>
        <input type="file" name="profile_photo" class="form-control" accept="image/*">
        <div class="form-text">JPG, PNG, or WEBP. Max 2 MB.</div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('employees.index') }}" class="btn btn-light">Cancel</a>
    <button type="submit" class="btn btn-primary">{{ $buttonText }}</button>
</div>
