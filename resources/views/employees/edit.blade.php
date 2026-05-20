<x-app-layout>
    <x-slot:title>Edit Employee</x-slot:title>

    <div class="card table-card">
        <div class="card-header bg-white border-0 p-4 pb-0">
            <h2 class="h5 mb-1">{{ $employee->full_name }}</h2>
            <p class="text-muted mb-0">Update employee profile and upload a replacement photo when needed.</p>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('employees.update', $employee) }}" enctype="multipart/form-data">
                @method('PUT')
                @include('employees._form', ['buttonText' => 'Save Changes'])
            </form>
        </div>
    </div>
</x-app-layout>
