<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="overflow-x-hidden min-h-screen" x-data="{ 
    showLogin: false, 
    showNavbar: true, 
    showFeatures: false, 
    showHome: true,
    activeSection: 'home'
}" x-init="
    showHome = true;
    activeSection = 'home';
">



                <!-- Success Message -->
                @if (session('success'))
                <div class="fixed top-4 right-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-lg z-50"
                    x-data="{ showNotification: true }"
                    x-init="setTimeout(() => showNotification = false, 3000)"
                    x-show="showNotification"
                    x-transition.duration.500ms>
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                <div class="fixed top-4 right-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl shadow-lg z-50"
                    x-data="{ showNotification: true }"
                    x-init="setTimeout(() => showNotification = false, 3000)"
                    x-show="showNotification"
                    x-transition.duration.500ms>
                    <p>{{ session('error') }}</p>
                </div>
                @endif
    
    <video src="{{ asset('background/vid2.mp4') }}"
        class="fixed top-0 left-0 w-full h-full object-cover -z-10"
        autoplay loop muted playsinline></video>

    <!-- Navigation -->
    <header class="w-full px-4 sm:px-6 lg:px-8 pt-4 sm:pt-6 lg:pt-8 relative z-10" x-show="showNavbar">
        <div class="max-w-6xl mx-auto">

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center justify-between bg-orange-600 rounded-full py-4 px-6 lg:px-8 shadow-lg">
                <p class="text-lg lg:text-xl font-bold text-violet-200">{{ config('app.name') }}</p>
                <nav>
                    <ul class="flex gap-6 lg:gap-8 text-slate-50 font-semibold">
                        <li class="relative">
                            <button @click="showHome = true; showLogin = false; showFeatures = false; activeSection = 'home'"
                                class="relative px-4 py-2 rounded-lg transition-all duration-300 hover:text-violet-200 hover:bg-orange-500"
                                :class="activeSection === 'home' ? 'text-violet-200 bg-orange-500' : 'text-slate-50'">
                                Home
                            </button>
                        </li>
                        <li class="relative">
                            <button @click="showFeatures = true; showLogin = false; showHome = false; activeSection = 'features'"
                                class="relative px-4 py-2 rounded-lg transition-all duration-300 hover:text-violet-200 hover:bg-orange-500"
                                :class="activeSection === 'features' ? 'text-violet-200 bg-orange-500' : 'text-slate-50'">
                                Features
                            </button>
                        </li>
                        <li class="relative">
                            <button @click="showLogin = true; showHome = false; showFeatures = false; activeSection = 'login'"
                                class="relative px-4 py-2 rounded-lg transition-all duration-300 hover:text-violet-200 hover:bg-orange-500"
                                :class="activeSection === 'login' ? 'text-violet-200 bg-orange-500' : 'text-slate-50'">
                                Login
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>

            
            <div class="md:hidden" x-data="{ mobileMenuOpen: false }">
                <div class="bg-orange-600 rounded-full py-3 px-4 shadow-lg flex items-center justify-between">
                    <p class="text-lg font-bold text-violet-200">{{ config('app.name') }}</p>
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="text-slate-50 hover:text-violet-200 transition-colors duration-300 p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                
                <nav x-show="mobileMenuOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95"
                    class="mt-2 bg-orange-600 rounded-2xl py-4 px-4 shadow-lg">
                    <ul class="space-y-3 text-slate-50 font-semibold">
                        <li>
                            <button @click="showHome = true; showLogin = false; showFeatures = false; activeSection = 'home'; mobileMenuOpen = false"
                                class="w-full text-left flex items-center justify-between px-4 py-3 rounded-lg transition-colors duration-300 hover:bg-orange-500"
                                :class="activeSection === 'home' ? 'bg-orange-500 text-violet-200' : ''">
                                <span>Home</span>
                            </button>
                        </li>
                        <li>
                            <button @click="showFeatures = true; showLogin = false; showHome = false; activeSection = 'features'; mobileMenuOpen = false"
                                class="w-full text-left flex items-center justify-between px-4 py-3 rounded-lg transition-colors duration-300 hover:bg-orange-500"
                                :class="activeSection === 'features' ? 'bg-orange-500 text-violet-200' : ''">
                                <span>Features</span>
                            </button>
                        </li>
                        <li>
                            <button @click="showLogin = true; showHome = false; showFeatures = false; activeSection = 'login'; mobileMenuOpen = false"
                                class="w-full text-left flex items-center justify-between px-4 py-3 rounded-lg transition-colors duration-300 hover:bg-orange-500"
                                :class="activeSection === 'login' ? 'bg-orange-500 text-violet-200' : ''">
                                <span>Login</span>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-8 sm:py-12 lg:py-16 relative z-10 min-h-screen">
        <div class="w-full max-w-7xl mx-auto">

            <!-- Home Component -->
            <div x-show="showHome"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="flex items-center justify-center min-h-[60vh]">
                <div class="w-full max-w-xs sm:max-w-md lg:max-w-2xl xl:max-w-3xl">
                    <div class="rounded-2xl border border-orange-200 shadow-2xl shadow-orange-400 
                               bg-gradient-to-tl from-orange-800 to-orange-100 p-6 sm:p-8 lg:p-12 
                               transition-all duration-700 hover:shadow-xl">
                        <div class="text-center space-y-6 sm:space-y-8">

                            <p class="text-orange-600 text-base sm:text-lg lg:text-xl xl:text-2xl leading-relaxed max-w-2xl mx-auto">
                                This app is a simple demo of a Laravel application to demonstrate basic CRUD operations with modern design
                            </p>

                            <div class="flex flex-col sm:flex-row justify-center gap-4 sm:gap-6 pt-4">
                                <button @click="showFeatures = true; showHome = false; activeSection = 'features'"
                                    class="inline-flex items-center justify-center border-1.5 border-orange-300 px-6 sm:px-4 py-1 sm:py-2 rounded-full 
                                          text-orange-500 bg-slate-50 text-base sm:text-lg font-semibold 
                                          hover:bg-orange-400 hover:text-slate-50 transition duration-500">
                                    View Features
                                </button>
                                <button @click="showLogin = true; showHome = false; activeSection = 'login'"
                                    class="inline-flex items-center justify-center border-1.5 border-orange-400 px-6 sm:px-4 py-1 sm:py-2 rounded-full 
                                          text-base sm:text-lg font-semibold bg-orange-400 hover:bg-orange-500 text-slate-50 
                                          transition duration-700">
                                    Get Started
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Component -->
            <div x-show="showFeatures"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="flex items-center justify-center min-h-[60vh]">
                <div class="w-full max-w-4xl">
                    <div class="rounded-2xl border border-orange-200 shadow-2xl shadow-orange-400 
                               bg-gradient-to-tl from-orange-800 to-orange-100 p-6 sm:p-8 lg:p-12">
                       <p class="text-orange-500 text-xl font-semibold">There are tons of exciting features in this app. Why don't you give it a try?
                            <br>
                            For Now We don't register new users, Sorry<x-heroicon-o-face-frown class="w-6 h-6"/>
                       </p>
                       <button @click="showLogin = true; showFeatures =false" class="bg-slate-50 border-1.5 border-orange-500 mt-4  rounded-full px-4 py-1 text-orange-400 hover:text-slate-50 hover:bg-orange-400">Try Now</button>
                    </div>
                </div>
            </div>

            <!-- Login Component -->
            <div x-show="showLogin"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95"
                class="flex items-center justify-center min-h-[60vh]">



                <div class="w-full max-w-xs sm:max-w-md">
                    <div class="rounded-2xl border border-orange-200 shadow-2xl shadow-orange-400 
                               bg-gradient-to-tl from-orange-800 to-orange-100 p-6 sm:p-8 lg:p-10">
                        <div class="text-center mb-8">
                            <h2 class="text-2xl sm:text-3xl font-bold text-orange-800">Login</h2>
                        </div>

                        <form action="{{ route('login/auth') }}" method="post" class="space-y-6">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <input type="text"
                                        id="usernameOrEmail"
                                        name="usernameOrEmail"
                                        required
                                        class="w-full h-12 px-4 rounded-xl border-2 border-orange-300 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-200 transition-colors duration-300"
                                        placeholder="Username or Email">
                                </div>

                                <div>
                                    <input type="password"
                                        id="password"
                                        name="password"
                                        required
                                        class="w-full h-12 px-4 rounded-xl border-2 border-orange-300 focus:border-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-200 transition-colors duration-300"
                                        placeholder="Enter your password">
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-orange-500 hover:bg-orange-600 h-12 rounded-xl text-slate-50 font-semibold 
                                           active:scale-95 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-orange-400 focus:ring-offset-2">
                                Sign In
                            </button>
                        </form>

                        <div class="text-center mt-6">
                            <button @click="showHome = true; showLogin = false; activeSection = 'home'"
                                class="text-orange-600 hover:text-orange-700 font-medium transition-colors duration-300">
                                Back to Home
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>

</html>