<x-app-layout>
    <x-slot:title>Employees</x-slot:title>

    <div class="card toolbar-card mb-4">
        <div class="card-body">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <form class="row g-2 flex-grow-1" method="GET" action="{{ route('employees.index') }}">
                    <div class="col-sm-8 col-lg-5">
                        <input type="search" name="search" class="form-control" placeholder="Search by name, ID, email, department" value="{{ $search }}">
                    </div>
                    <div class="col-sm-4 col-lg-2 d-grid">
                        <button class="btn btn-outline-primary">Search</button>
                    </div>
                </form>
                <a href="{{ route('employees.create') }}" class="btn btn-primary">Add Employee</a>
            </div>
        </div>
    </div>

    <div class="card table-card">
        <div class="card-header bg-white border-0 p-4 pb-0">
            <h2 class="h5 mb-1">Employee Directory</h2>
            <p class="text-muted mb-0">Manage employee profiles, departments, and profile photos.</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle table-hover">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>ID</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Joined</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img class="avatar" src="{{ $employee->profile_photo ? asset('storage/'.$employee->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($employee->full_name).'&background=2563eb&color=fff' }}" alt="{{ $employee->full_name }}">
                                        <div>
                                            <div class="fw-semibold">{{ $employee->full_name }}</div>
                                            <div class="text-muted small">{{ $employee->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $employee->employee_id }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->join_date->format('M d, Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-light">View</a>
                                    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form class="d-inline" method="POST" action="{{ route('employees.destroy', $employee) }}" onsubmit="return confirm('Delete this employee?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No employees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
