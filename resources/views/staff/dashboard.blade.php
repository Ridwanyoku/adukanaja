<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    @include('layouts.nav')
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-4">Staff Dashboard</h1>
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
    </div>
</body>
</html>