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

<div class="mt-8">
    <h2 class="text-xl font-semibold mb-2">My Reports</h2>
    @if($reports->isEmpty())
        <p class="text-gray-600">You have not submitted any reports yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Content
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Responses
                        </th>
                        <th scope="col" class="relative px-6 py-3">
                            <span class="sr-only">Details</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($reports as $report)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ Str::limit($report->content, 50, '...') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-now-wrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $report->status === '0' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $report->status === '0' ? 'Pending' : ucfirst($report->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $report->date }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                @if($report->responses->isNotEmpty())
                                    {{-- Tampilkan ringkasan respons di sini --}}
                                    @foreach($report->responses as $response)
                                        <div class="mb-2">
                                            <div class="text-sm text-gray-700">{{ Str::limit($response->response_content, 50) }}</div>
                                            <div class="text-xs text-gray-500">By: {{ $response->admin->name ?? 'Unknown' }}</div>
                                        </div>
                                    @endforeach
                                @else
                                    No response yet.
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('reports.show', $report->id) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
    </div>
</body>
</html>