<x-app-layout>
    <x-slot:title>Edit Attendance Record</x-slot:title>

    <div class="card table-card">
        <div class="card-body">
            <form method="POST" action="{{ route('attendances.update', $attendance) }}">
                @method('PUT')
                @include('attendances._form', ['buttonText' => 'Save Changes'])
            </form>
        </div>
    </div>
</x-app-layout>
