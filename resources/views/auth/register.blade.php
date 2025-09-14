<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex h-screen bg-white-100 p-10">
    <div class="w-full max-w-xs m-auto bg-red-50 rounded p-5">   
        <header>
            <img class="w-200 mx-auto mb-5" src="{{asset('images/logo.png')}}" />
        </header>   
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <label class="block mb-2 text-red-500" for="nik">NIK</label>
                <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('nik') border-red-500 @enderror" type="text" name="nik" value="{{ old('nik') }}" required>
                @error('nik')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-red-500" for="name">Name</label>
                <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('name') border-red-500 @enderror" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-red-500" for="username">Username</label>
                <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('username') border-red-500 @enderror" type="text" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-red-500" for="password">Password</label>
                <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('password') border-red-500 @enderror" type="password" name="password" required>
                @error('password')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-red-500" for="password_confirmation">Confirm Password</label>
                <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300" type="password" name="password_confirmation" required>
            </div>
            <div>
                <label class="block mb-2 text-red-500" for="telephone">Telephone</label>
                <input class="w-full p-2 mb-6 text-red-700 border-b-2 border-red-500 outline-none focus:bg-gray-300 @error('telephone') border-red-500 @enderror" type="text" name="telephone" value="{{ old('telephone') }}" required>
                @error('telephone')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div>          
                <input class="w-full bg-red-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit" value="Register">
            </div>       
        </form>  
        <footer>
            <a class="text-red-700 hover:text-pink-700 text-sm float-left" href="#">Forgot Password?</a>
            <a class="text-red-700 hover:text-pink-700 text-sm float-right" href="{{ route('login') }}">Login</a>
        </footer>   
    </div>
</body>
</html>