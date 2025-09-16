<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Report Detail</h1>
        @if ($report)
            <div class="bg-white p-4 rounded shadow">
                <p><strong>Content:</strong> {{ $report->content }}</p>
                <p><strong>User:</strong> {{ $report->user->name }}</p>
                <p><strong>Status:</strong> {{ $report->status === '0' ? 'Pending' : ucfirst($report->status) }}</p>
                <p><strong>Date:</strong> {{ $report->date }}</p>
                @if ($report->image)
                    <p><strong>Image:</strong></p>
                    <img src="{{ asset('storage/' . $report->image) }}" height="200" width="200" alt="Report Image" class="mt-2 max-w-xs md:max-w-md rounded">
                @endif
                <h2 class="text-xl font-semibold mt-4">Responses</h2>
                @if ($report->responses->isEmpty())
                    <p class="text-gray-600">No responses yet.</p>
                @else
                    <ul class="mt-2 space-y-2">
                        @foreach ($report->responses as $response)
                            <li class="bg-gray-50 p-2 rounded">
                                <p><strong>Admin:</strong> {{ $response->admin->name }}</p>
                                <p><strong>Response:</strong> {{ $response->response_content }}</p>
                                <p><strong>Date:</strong> {{ $response->date }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif
                <button type="button" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="document.getElementById('editModal').classList.remove('hidden')">Edit</button>
            </div>
            <!-- Edit Modal -->
            <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md">
                    <h2 class="text-xl font-bold mb-4">Edit Report</h2>
                    @if ($errors->any())
                        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('reports.update', $report->id) }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('PUT')
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea id="content" name="content" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('content') border-red-500 @enderror" required>{{ old('content', $report->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700">Image (Optional)</label>
                            <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('image') border-red-500 @enderror">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            @if ($report->image)
                                <p class="mt-2 text-sm text-gray-700">Current Image:</p>
                                <img src="{{ asset('storage/' . $report->image) }}" alt="Current Image" class="mt-1 max-w-xs rounded">
                            @endif
                        </div>
                        <div class="flex justify-end space-x-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                            <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600" onclick="document.getElementById('editModal').classList.add('hidden')">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <p class="text-red-600">Report not found.</p>
        @endif
    </div>
</body>
</html>