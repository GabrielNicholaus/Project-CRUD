<x-app-layout>
    <x-slot:title>Employee Details</x-slot:title>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card table-card">
                <div class="card-body text-center">
                    <img class="rounded-circle mb-3" width="120" height="120" style="object-fit: cover" src="{{ $employee->profile_photo ? asset('storage/'.$employee->profile_photo) : 'https://ui-avatars.com/api/?size=160&name='.urlencode($employee->full_name).'&background=2563eb&color=fff' }}" alt="{{ $employee->full_name }}">
                    <h2 class="h5 mb-1">{{ $employee->full_name }}</h2>
                    <div class="text-muted">{{ $employee->position }}</div>
                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-primary mt-3">Edit Employee</a>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card table-card">
                <div class="card-header bg-white fw-semibold">Profile Information</div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6"><div class="text-muted small">Employee ID</div><div class="fw-semibold">{{ $employee->employee_id }}</div></div>
                        <div class="col-md-6"><div class="text-muted small">Email</div><div class="fw-semibold">{{ $employee->email }}</div></div>
                        <div class="col-md-6"><div class="text-muted small">Phone</div><div class="fw-semibold">{{ $employee->phone_number ?? '-' }}</div></div>
                        <div class="col-md-6"><div class="text-muted small">Department</div><div class="fw-semibold">{{ $employee->department }}</div></div>
                        <div class="col-md-6"><div class="text-muted small">Join Date</div><div class="fw-semibold">{{ $employee->join_date->format('M d, Y') }}</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
