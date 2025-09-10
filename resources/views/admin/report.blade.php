<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reports</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">All Reports</h1>
        @if (App\Models\Report::count() == 0)
            <p class="text-gray-600">No reports found.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border">Content</th>
                            <th class="p-2 border">User</th>
                            <th class="p-2 border">Status</th>
                            <th class="p-2 border">Date</th>
                            <th class="p-2 border">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (App\Models\Report::with('user')->get() as $report)
                            <tr class="hover:bg-gray-100">
                                <td class="p-2 border">{{ Str::limit($report->content, 50) }}</td>
                                <td class="p-2 border">{{ $report->user ? $report->user->nama : 'Anonymous' }}</td>
                                <td class="p-2 border">{{ $report->status === '0' ? 'Pending' : ucfirst($report->status) }}</td>
                                <td class="p-2 border">{{ $report->date }}</td>
                                <td class="p-2 border"><a href="{{ route('admin.show', $report->id) }}" class="text-blue-500 hover:underline">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</body>
</html>