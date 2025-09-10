<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Responses</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">My Responses</h1>
        @if (Auth::guard('user')->user()->reports->responses->isEmpty())
            <p class="text-gray-600">No responses yet.</p>
        @else
            <ul class="space-y-4">
                @foreach (Auth::guard('user')->user()->reports as $report)
                    @foreach ($report->responses as $response)
                        <li class="bg-white p-4 rounded shadow">
                            <p><strong>Report:</strong> {{ $report->content }}</p>
                            <p><strong>Response:</strong> {{ $response->response_content }}</p>
                            <p><strong>Admin:</strong> {{ $response->admin->nama }}</p>
                            <p><strong>Date:</strong> {{ $response->date }}</p>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        @endif
    </div>
</body>
</html>