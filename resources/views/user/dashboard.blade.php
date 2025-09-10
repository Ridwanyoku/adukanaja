<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">User Dashboard</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold">Total Reports</h2>
                <p class="text-2xl">{{ App\Models\Report::count() }}</p>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-xl font-semibold">Total Responses</h2>
                <p class="text-2xl">{{ App\Models\Response::count() }}</p>
            </div>
        </div>

        <!-- Tambahkan di bawah statistik atau di mana pun kamu mau -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-2">My Reports</h2>
            @if($reports->isEmpty())
                <p class="text-gray-600">You have not submitted any reports yet.</p>
            @else
                <ul class="space-y-4">
                    @foreach($reports as $report)
                        <li class="bg-white p-4 rounded shadow">
                            <p><strong>Content:</strong> {{ $report->content }}</p>
                            <p><strong>Status:</strong> {{ $report->status === '0' ? 'Pending' : ucfirst($report->status) }}</p>
                            <p><strong>Date:</strong> {{ $report->date }}</p>
                            <a href="{{ route('reports.show', $report->id) }}" class="text-blue-500 hover:underline">Detail</a>

                            {{-- Tampilkan responses --}}
                            @if($report->responses->isNotEmpty())
                                <div class="mt-4 bg-gray-50 p-3 rounded">
                                    <h3 class="font-semibold mb-1">Responses:</h3>
                                    <ul class="space-y-2">
                                        @foreach($report->responses as $response)
                                            <li>
                                                <div class="text-sm text-gray-700">{{ $response->response_content }}</div>
                                                <div class="text-xs text-gray-500">By: {{ $response->admin->nama ?? 'Unknown' }} | {{ $response->date }}</div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="mt-4 text-gray-500 text-sm">No response yet.</div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</body>
</html>