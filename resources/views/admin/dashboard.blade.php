    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body>
        @include('layouts.nav')
        <div class="container mx-auto p-4">
            <h1 class="text-3xl font-bold mb-4">Admin Dashboard</h1>
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
                <h2 class="text-xl font-semibold mb-2 mt-5">Staff List</h2>
                @if ($staffs->isEmpty())
                <p class="text-gray-600">nothing</p>
                @else
                <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Username</th>
                            <th class="p-2 text-left">Telephone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($staffs as $staff)
                        <tr class="border-b">
                            <td class="p-2">{{ $staff->name }}</td>
                            <td class="p-2">{{ $staff->username }}</td>
                            <td class="p-2">{{ $staff->telephone }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
            <h2 class="text-xl font-semibold mb-2 mt-5">User List</h2>
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 text-left">NIK</th>
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Username</th>
                            <th class="p-2 text-left">Telephone</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b">
                                <td class="p-2">{{ $user->nik }}</td>
                                <td class="p-2">{{ $user->name }}</td>
                                <td class="p-2">{{ $user->username }}</td>
                                <td class="p-2">{{ $user->telephone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </body>
    </html>