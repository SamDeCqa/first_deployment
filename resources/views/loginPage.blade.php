<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Login</title>
</head>
<body class="bg-gradient-to-tr from-amber-300 via-amber-200 to-amber-100">
    @if (session('success'))
        <div class="bg-green-200 text-green-500 font-semibold p-4 rounded-xl h-fit w-fit">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="fixed right-4 top-4 bg-red-200 text-red-500 font-semibold p-4  rounded-xl h-fit w-fit"
                x-data="{ showNotification: true }"
                x-init="setTimeout(()=> showNotification = false, 2000)"
                x-show="showNotification"
                x-transtion.duration.700ms>
            <p class="justify-center items-center">{{ session('error') }}</p>
        </div>
    @endif
    <div class="flex justify-center items-center h-screen w-screen">
            <div class="p-8 bg-orange-200 rounded-2xl shadow-2xl w-fit"> 
         <p class="text-xl font-bold">Login</p>
        <form action="{{ route('login/auth') }}" method="post" class="grid space-y-5">
            @csrf
            <input type="text" name="usernameOrEmail" class="md:w-96 h-12 px-4 rounded-xl border-2 border-gray-500">
            <input type="password" name="password" class="md:w-96 h-12 px-4 rounded-xl border-2 border-gray-500">
            <button type="submit" class="bg-orange-500 md:w-96 h-12 rounded-lg text-slate-50 active:scale-95 duration-300">
                Login
            </button>
        </form>
    </div>
    </div>


    
</body>
</html>