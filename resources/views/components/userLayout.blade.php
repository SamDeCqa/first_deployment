<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>User</title>
</head>
<body class="bg-slate-50 min-h-screen" x-data="{ sidebarOpen: false }">

    
    @if (session('success'))
        <div class="fixed top-6 right-6 z-50 bg-white border border-emerald-200 text-emerald-700 px-4 sm:px-6 py-4 rounded-lg shadow-lg max-w-xs sm:max-w-sm"
             x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2">
            <div class="flex items-start">
                <div class="w-5 h-5 bg-emerald-500 rounded-full mt-0.5 mr-3 flex-shrink-0"></div>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif
    
    @if (session('error'))
        <div class="fixed top-6 right-6 z-50 bg-white border border-red-200 text-red-700 px-4 sm:px-6 py-4 rounded-lg shadow-lg max-w-xs sm:max-w-sm"
             x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-2">
            <div class="flex items-start">
                <div class="w-5 h-5 bg-red-500 rounded-full mt-0.5 mr-3"></div>
                <p class="text-sm font-medium">{{ session('error') }}</p>
            </div>
        </div>
    @endif

   
    <header class="lg:hidden bg-white border-b border-gray-200 px-4 py-4 flex items-center justify-between">
        <h1 class="text-xl font-bold text-orange-400">{{ config('app.name') }}</h1>
        <button @click="sidebarOpen = !sidebarOpen" class="p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
            <x-heroicon-o-bars-3  class="w-6 h-6"/>
        </button>
    </header>

    
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 backdrop-blur-xs bg-opacity-50 z-20 lg:hidden"
         style="display: none;"></div>

   
    <div class="flex min-h-screen">
        
        <aside class="fixed inset-y-0 left-0 z-30 w-64 bg-[#FDFDFD] border-r border-gray-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 lg:w-72 flex flex-col"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            
            <div class="p-6 hidden lg:block">
                <h1 class="text-xl font-bold text-orange-400">{{ config('app.name') }}</h1>
            </div>

            
            <div class="p-4 border-b border-gray-200 lg:hidden flex items-center justify-between">
                <h1 class="text-xl font-bold text-orange-400">{{ config('app.name') }}</h1>
                <button @click="sidebarOpen = false" class="p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100">
                    <x-heroicon-o-bars-3 class="w-6 h-6"/>
                </button>
            </div>

            <!-- Navigation Link Hizi -->
            <nav class="flex-1 px-4 py-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('userDashboard') }}" 
                           @click="sidebarOpen = false"
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:text-gray-900 transition-colors duration-200
                                    {{ request()->routeIs('userDashboard') ? 'bg-orange-300' : 'bg-[#FDFDFD] hover:bg-orange-50' }}">
                            <x-heroicon-o-home class="w-6 h-6"/>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('userProjects') }}" 
                           @click="sidebarOpen = false"
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:text-gray-900 transition-colors duration-200
                                    {{ request()->routeIs('userProjects') ? 'bg-orange-300' : 'bg-[#FDFDFD] hover:bg-orange-50' }}">
                            <x-heroicon-o-beaker class="w-6 h-6"/>
                            My Projects
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('userSettings') }}" 
                           @click="sidebarOpen = false"
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg text-gray-700 hover:text-gray-900 transition-colors duration-200
                                    {{ request()->routeIs('userSettings') ? 'bg-orange-300 ' : 'bg-[#FDFDFD] hover:bg-orange-50' }}">
                            <x-heroicon-o-cog-6-tooth class="w-6 h-6"/>
                            Settings
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Card ya User Basic Info -->
            <div class="p-4 border-t border-gray-200 bg-[#F2F8FC]">
                <div class="flex items-center space-x-3 p-3">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-sm font-bold text-gray-600">
                            {{ substr(Auth()->user()->name, 0, 1) }}
                        </span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth()->user()->email }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('logout') }}" 
                       class="w-full flex justify-center py-2 px-4 border border-red-300 rounded-md text-sm font-medium text-red-600 bg-red-300 hover:bg-red-400 hover:text-slate-50 hover:border-red-400 transition-colors duration-200">
                       <x-heroicon-o-arrow-left-start-on-rectangle class="w-6 h-6"/>
                        Logout
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 lg:ml-0 pt-16 lg:pt-0">
            <div class="p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>
</html>