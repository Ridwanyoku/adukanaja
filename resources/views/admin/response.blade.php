<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Response</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Add Response</h1>
        <form method="POST" action="{{ route('admin.reports.responses.store', $report) }}" class="space-y-4">
            @csrf
            <div>
                <label for="response_content" class="block text-sm font-medium text-gray-700">Response</label>
                <textarea id="response_content" name="response_content" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('response_content') border-red-500 @enderror" required>{{ old('response_content') }}</textarea>
                @error('response_content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <input type="hidden" name="admin_id" value="{{ Auth::guard('admins')->user()->id }}">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit Response</button>
        </form>
    </div>
</body>
</html>