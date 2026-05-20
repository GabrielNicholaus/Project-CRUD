<x-app-layout>
    <x-slot:title>Activity Logs</x-slot:title>

    <div class="card table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Action</th>
                            <th>Description</th>
                            <th>IP Address</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activityLogs as $log)
                            <tr>
                                <td>{{ $log->user->name ?? 'System' }}</td>
                                <td><span class="badge text-bg-secondary">{{ $log->action }}</span></td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->ip_address ?? '-' }}</td>
                                <td>{{ $log->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No activity logs yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $activityLogs->links() }}
        </div>
    </div>
</x-app-layout>
