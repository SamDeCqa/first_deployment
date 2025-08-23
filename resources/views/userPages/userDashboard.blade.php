<x-userLayout>
    <div class="space-y-6 lg:space-y-8">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-4">
            <div class="flex-1 min-w-0">
                <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 truncate">Welcome, {{ Auth()->user()->name }}</h1>
                <p class="text-sm text-gray-600 mt-1">Here's what's happening with your projects today</p>
            </div>
            <div class="flex-shrink-0">
                <p class="text-sm sm:text-base font-semibold text-gray-900">{{ now()->format('l M d, Y')}}</p>
            </div>
        </div>

        <!-- Projects Overview -->
        <div>
            <h2 class="text-base sm:text-lg font-medium text-gray-900 mb-4">Projects Overview</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <!-- Completed Projects -->
                <div class="bg-white rounded-lg border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-xl sm:text-2xl font-semibold text-gray-900">{{ $completed ?? '0' }}</p>
                            <p class="text-sm font-medium text-gray-600 mt-1">Completed Projects</p>
                        </div>
                            <x-heroicon-o-shield-check class="w-24 h-24 text-green-600"/>
                    </div>
                    <div class="mt-3 sm:mt-4">
                        <div class="flex items-center text-sm text-emerald-600">
                            <span class="font-medium">Kudos!</span>
                        </div>
                    </div>
                </div>

                <!-- Pending Projects -->
                <div class="bg-white rounded-lg border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-xl sm:text-2xl font-semibold text-gray-900">{{ $pending ?? '0' }}</p>
                            <p class="text-sm font-medium text-gray-600 mt-1">Pending Projects</p>
                        </div>
                        <x-heroicon-o-bell class="w-24 h-24 text-amber-600"/>
                    </div>
                    <div class="mt-3 sm:mt-4">
                        <div class="flex items-center text-sm text-amber-600">
                            <span class="font-medium">Awaiting action</span>
                        </div>
                    </div>
                </div>

                <!-- In Progress Projects -->
                <div class="bg-white rounded-lg border border-gray-200 p-4 sm:p-6 hover:shadow-md transition-shadow duration-200 sm:col-span-2 lg:col-span-1">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <p class="text-xl sm:text-2xl font-semibold text-gray-900">{{ $inProgress ?? '0' }}</p>
                            <p class="text-sm font-medium text-gray-600 mt-1">In Progress</p>
                        </div>
                        <x-heroicon-o-rocket-launch class="w-24 h-24"/>
                    </div>
                    <div class="mt-3 sm:mt-4">
                        <div class="flex items-center text-sm text-blue-600">
                            <span class="font-medium">Keep pushing!</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200">
                <h3 class="text-base sm:text-lg font-medium text-gray-900">Recent Projects</h3>
                <p class="mt-1 text-sm text-gray-600">Your latest project activity</p>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse ($projects as $project)
                    <div class="px-4 sm:px-6 py-4 hover:bg-gray-50 transition-colors duration-150">
                        <p class="text-xs rounded-full w-fit bg-gray-200 px-2 py-1 mb-3 sm:mb-4">{{ $project->updated_at->diffForHumans() ?? 'N/A'}}</p>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <h4 class="text-base sm:text-lg font-medium text-gray-900 truncate">{{ $project->title }}</h4>
                                <p class="mt-1 text-sm text-gray-500 line-clamp-2 sm:truncate sm:max-w-md">{{ $project->description }}</p>
                            </div>
                            <div class="flex-shrink-0 self-start sm:self-center">
                                @if ($project->status == 'Completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs sm:text-sm font-medium bg-green-100 text-green-800">
                                        {{ $project->status }}
                                    </span>
                                @elseif($project->status == 'Pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs sm:text-sm font-medium bg-pink-100 text-pink-800">
                                        {{ $project->status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs sm:text-sm font-medium bg-amber-100 text-amber-800">
                                        {{ $project->status }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-4 sm:px-6 py-8 sm:py-12 text-center">
                        <x-heroicon-o-face-frown class="w-24 h-24 text-red-500"/>
                        <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">No projects yet</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 max-w-sm mx-auto">Get started by creating your first project</p>
                        <button class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                            Create New Project
                        </button>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-userLayout>