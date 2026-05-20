<x-app-layout>
    <x-slot:title>Add Attendance Record</x-slot:title>

    <div class="card table-card">
        <div class="card-body">
            <form method="POST" action="{{ route('attendances.store') }}">
                @include('attendances._form', ['attendance' => null, 'buttonText' => 'Create Record'])
            </form>
        </div>
    </div>
</x-app-layout>
