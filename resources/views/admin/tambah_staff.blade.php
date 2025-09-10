<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Add New Staff</h1>
        <form method="POST" action="{{ route('admin.tambah_staff.store') }}" class="space-y-4">
            @csrf
            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="nama" name="nama" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('nama') border-red-500 @enderror" required>
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('username') border-red-500 @enderror" required>
                @error('username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('password') border-red-500 @enderror" required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="telp" class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" id="telp" name="telp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('telp') border-red-500 @enderror" required>
                @error('telp')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Staff</button>
        </form>
    </div>
</body>
</html>