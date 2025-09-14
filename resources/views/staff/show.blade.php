<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Details for Response</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body x-data="{ openModal: false, editingResponseId: null, editingResponseContent: '' }">
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Report Details for Response</h1>
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        <div class="space-y-4">
            <p><strong>Content:</strong></p>
            <p class="p-2 bg-gray-50 rounded">{{ $report->content }}</p>
            <p><strong>User:</strong> {{ $report->user ? $report->user->name : 'Anonymous' }}</p>
            <p><strong>Status:</strong> {{ $report->status === '0' ? 'Pending' : ucfirst($report->status) }}</p>
            <p><strong>Date:</strong> {{ $report->date }}</p>
            @if ($report->image)
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $report->image) }}" alt="Report Image" class="mt-2 max-w-xs md:max-w-md lg:max-w-lg rounded">
            @endif
            <h6 class="text-lg font-semibold mt-4">Responses:</h6>
            @if ($report->responses->isEmpty())
                <p class="text-gray-600">No responses yet.</p>
            @else
                <ul class="list-disc pl-5 mt-2 space-y-2">
                    @foreach ($report->responses as $response)
                        <li class="bg-gray-50 p-2 rounded">
                            <strong>{{ $response->admin->nama }} ({{ $response->admin->isAdmin() ? 'Admin' : 'Staff' }})</strong> - {{ $response->date }}
                            <p class="mt-1">{{ $response->response_content }}</p>
                            <button @click="openModal = true; editingResponseId = '{{ $response->id }}'; editingResponseContent = '{{ addslashes($response->response_content) }}'" class="text-yellow-500 hover:underline">Edit</button>
                            <form action="{{ route('staff.response.destroy', $response) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @endif
            <h6 class="text-lg font-semibold mt-4">Add Response:</h6>
            <form method="POST" action="{{ route('staff.response.store', $report) }}" class="space-y-4">
                @csrf
                <div>
                    <label for="response_content" class="block text-sm font-medium text-gray-700">Response</label>
                    <textarea id="response_content" name="response_content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('response_content') border-red-500 @enderror" required>{{ old('response_content') }}</textarea>
                    @error('response_content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Response</button>
            </form>

            <!-- Form Ubah Status -->
            <h6 class="text-lg font-semibold mt-4">Ubah Status:</h6>
            <form method="POST" action="{{ route('staff.response.update-status', $report) }}" class="space-y-4">
                @csrf
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="0" {{ $report->status === '0' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ $report->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="resolved" {{ $report->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Update Status</button>
            </form>

            <a href="{{ route('staff.response') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Responses</a>
            <a href="{{ route('staff.dashboard') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back to Dashboard</a>
            <a href="{{ route('admin.logout') }}" class="mt-4 inline-block bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <!-- Pop Up Edit Modal -->
    <div x-show="openModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h3 class="text-xl font-bold mb-4">Edit Response</h3>
            {{-- <form method="POST" x-bind:action="'{{ route('staff.response.update', '') }}/' + editingResponseId"> --}}
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="response_content" class="block text-sm font-medium text-gray-700">Response Content</label>
                    <textarea x-model="editingResponseContent" id="response_content" name="response_content" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                    @error('response_content')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                    <button @click="openModal = false" type="button" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>