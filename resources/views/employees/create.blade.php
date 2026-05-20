<x-app-layout>
    <x-slot:title>Add Employee</x-slot:title>

    <div class="card table-card">
        <div class="card-header bg-white border-0 p-4 pb-0">
            <h2 class="h5 mb-1">New Employee Profile</h2>
            <p class="text-muted mb-0">Add identity, contact, department, and profile photo information.</p>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                @include('employees._form', ['employee' => null, 'buttonText' => 'Create Employee'])
            </form>
        </div>
    </div>
</x-app-layout>
