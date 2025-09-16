<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">All Reports from User</h1>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if ($reports->isEmpty())
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
                        @foreach ($reports as $report)
                            <tr class="hover:bg-gray-100">
                                <td class="p-2 border">{{ Str::limit($report->content, 50) }}</td>
                                <td class="p-2 border">{{ $report->user ? $report->user->name : 'Anonymous' }}</td>
                                <td class="p-2 border">{{ $report->status === '0' ? 'Pending' : ucfirst($report->status) }}</td>
                                <td class="p-2 border">{{ $report->date }}</td>
                                <td class="p-2 border">
                                    <a href="{{ route('staff.show', $report) }}" class="text-blue-500 hover:underline">View & Respond</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        <a href="{{ route('staff.dashboard') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Dashboard</a>
    </div>
</body>
</html>