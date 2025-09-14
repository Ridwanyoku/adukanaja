<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdukanAja - Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-gray-100">
    <header class="bg-gray-300 py-4">
        <div class="container mx-auto flex justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="AdukanAja Logo" class="h-16"> <!-- Ganti dengan path logo yang sebenarnya -->
        </div>
    </header>
    <main class="container mx-auto p-4 text-center flex-grow">
        <h1 class="text-4xl font-bold text-black-50 mb-4">Selamat Datang di AdukanAja</h1>
        <p class="text-lg text-gray-700 mb-6">Platform untuk mengadukan masalah dan mendapatkan tanggapan cepat dari petugas.</p>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-indigo-700 text-white px-6 py-3 rounded hover:bg-indigo-600">Login</a>
            <a href="{{ route('register') }}" class="bg-pink-700 text-white px-6 py-3 rounded hover:bg-pink-600">Register</a>
        </div>
    </main>
    {{-- <footer class="bg-gray-800 text-white py-4 text-center mt-auto">
        <p>&copy; 2025 AdukanAja. All rights reserved.</p>
    </footer> --}}
</body>
</html>