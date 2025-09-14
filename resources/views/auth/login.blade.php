<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-white-100">
    <div class="w-full max-w-xs m-auto bg-red-50 rounded p-5">
        <header>
            <img class="w-200 mx-auto mb-5" src="{{ asset('images/logo.png') }}" alt="Logo">
        </header>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label class="block mb-2 text-red-500" for="nik">NIK</label>
                <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('nik') border-red-500 @enderror" 
                       type="text" 
                       name="nik" 
                       value="{{ old('nik') }}" 
                       required 
                       autofocus>
                @error('nik')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-red-500" for="password">Password</label>
                <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('password') border-red-500 @enderror" 
                       type="password" 
                       name="password" 
                       required>
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6 flex justify-between items-center">
                <label for="remember" class="flex items-center text-red-700 hover:text-pink-700 text-sm">
                    {{-- <input id="remember" type="checkbox" name="remember" class="form-checkbox h-4 w-4 text-red-600 transition duration-150 ease-in-out">
                    <span class="ml-2">{{ __('Remember me') }}</span> --}}
                </label>
            </div>
            <div>
                <input class="w-full bg-red-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded cursor-pointer" 
                       type="submit" 
                       value="{{ __('Log in') }}">
            </div>
        </form>
        <footer>
            {{-- <a class="text-red-700 hover:text-pink-700 text-sm float-left" href="#">Forgot Password?</a>
            <a class="text-red-700 hover:text-pink-700 text-sm float-right" href="{{ route('register') }}">Register</a> --}}
        </footer>
    </div>
</body>
</html>