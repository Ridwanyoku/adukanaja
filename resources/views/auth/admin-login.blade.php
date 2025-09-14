<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin/Staff</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-white-100">
    <div class="w-full max-w-xs m-auto bg-red-50 rounded p-5">
        <header class="text-center">
            <h3 class="text-2xl font-bold text-gray-800 p-5">Login Admin/Staff</h3>
            {{-- <img class="w-200 mx-auto my-5" src="{{ asset('images/logo.png') }}" alt="Logo"> --}}
        </header>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div>
                <label class="block mb-2 text-red-500" for="username">Username</label>
                <input type="text" 
                       class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('username') border-red-500 @enderror" 
                       id="username" 
                       name="username" 
                       value="{{ old('username') }}" 
                       required 
                       autofocus>
                @error('username')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-red-500" for="password">Password</label>
                <input type="password" 
                       class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('password') border-red-500 @enderror" 
                       id="password" 
                       name="password" 
                       required>
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 flex justify-start items-center">
                {{-- <input type="checkbox" 
                       class="form-checkbox h-4 w-4 text-red-600 transition duration-150 ease-in-out" 
                       id="remember" 
                       name="remember">
                <label class="ml-2 text-red-500" for="remember">Remember me</label> --}}
            </div>
            <button type="submit" 
                    class="w-full bg-red-700 hover:bg-pink-700 text-white font-bold py-2 px-4 rounded">Log in</button>
        </form>
    </div>
</body>
</html>