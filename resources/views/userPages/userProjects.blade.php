<x-userLayout>
    <div x-data="{ 
        showNewModal: false, 
        showEditModal: false, 
        showDeleteModal: false,
        projectChoosen: {}
    }" class="space-y-4 sm:space-y-6">
        
        <!-- Header Controls -->
        <div class="bg-[#FDFDFD] rounded-lg border border-gray-200 p-4 sm:p-6">
            <div class="flex flex-col lg:flex-row gap-4 lg:justify-between lg:items-center">
                <form action="{{ route('userDashboard') }}" method="get" class="flex-1">
                    @csrf
                    <div class="flex flex-col sm:flex-row gap-3 items-stretch sm:items-center w-full">
                        <div class="relative flex-1 sm:max-w-md lg:max-w-lg">
                            <input type="text" 
                                name="searchTerm"
                                class="w-full pl-4 pr-12 py-2.5 border border-gray-300 rounded-lg text-sm placeholder-gray-500 
                                        focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent" 
                                placeholder="Search projects...">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <!-- HAPA ICON -->
                            </div>
                        </div>
                        <button type="submit" class="px-4 py-2.5 border border-orange-400 text-gray-500 text-sm font-medium rounded-lg hover:bg-orange-400 active:scale-95
                                    hover:text-slate-50 focus:outline-none focus:ring-offset-2 focus:ring-orange-500 transition duration-500 flex-shrink-0">
                            Search
                        </button>                            
                    </div>
                </form>

                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-3">
                    <label class="text-sm font-medium text-gray-700 sm:flex-shrink-0">Sort by:</label>
                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500
                                    focus:border-transparent min-w-0 sm:min-w-[140px]">
                        <option value="" selected>All Projects</option>
                        <option value="completed">Completed</option>
                        <option value="in-progress">In Progress</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Projects Section -->
        <div class="bg-[#FDFDFD] rounded-lg border border-gray-200">
            <div class="px-4 sm:px-6 py-4 sm:py-5 border-b border-gray-200 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div>
                    <h2 class="text-lg font-medium text-gray-900">Projects</h2>
                    <p class="mt-1 text-sm text-gray-600">Manage and track all your projects</p>
                </div>
                <button @click="showNewModal = true" 
                        class="inline-flex items-center justify-center px-4 py-2 bg-gradient-to-tr from-orange-400 to-orange-300 border border-transparent
                                rounded-lg text-sm font-semibold text-slate-50 active:scale-95 transition duration-300 w-full sm:w-auto">
                    New Project
                </button>
            </div>

            <!-- Mobile Card View -->
            <div class="block lg:hidden divide-y divide-gray-200">
                @forelse ($projects as $index => $project)
                    <div class="p-4 sm:p-6 hover:bg-gray-50 transition-colors duration-150">
                        <div class="flex items-start justify-between mb-3">
                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded">#{{ $index + 1 }}</span>
                            <div class="flex items-center gap-2">
                                @if ($project->status == 'Completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        {{ $project->status }}
                                    </span>
                                @elseif($project->status == 'Pending')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                        {{ $project->status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                        {{ $project->status }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-sm font-medium text-gray-900 mb-2">{{ $project->title }}</h3>
                            <p class="text-sm text-gray-500 line-clamp-2">{{ $project->description }}</p>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row gap-2">
                            <button @click="showEditModal = true;projectChoosen = {id : '{{$project->id}}', title:'{{$project->title}}', description:'{{$project->description}}'}" 
                                    class="flex-1 sm:flex-initial inline-flex items-center justify-center px-3 py-1.5 border border-blue-500 rounded-md text-xs font-medium
                                           text-blue-700 bg-slate-50 hover:bg-blue-50 active:bg-blue-500 transition-colors duration-200">
                                Edit
                            </button>
                            <button @click="showDeleteModal = true;projectChoosen = {id : '{{$project->id}}', title:'{{$project->title}}', description:'{{$project->description}}'}" 
                                    class="flex-1 sm:flex-initial inline-flex items-center justify-center px-3 py-1.5 border border-red-300 rounded-md text-xs font-medium
                                          text-red-700 bg-red-300 hover:bg-red-400 hover:border-transparent hover:text-slate-50 active:scale-95 transition duration-200">
                                Delete
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="px-4 sm:px-6 py-8 sm:py-12 text-center">
                        <div class="mx-auto w-16 h-16 sm:w-24 sm:h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <!-- Icon hapa -->
                        </div>
                        <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2">No projects found</h3>
                        <p class="text-sm sm:text-base text-gray-600 mb-4 sm:mb-6 max-w-sm mx-auto">Get started by creating your first project</p>
                        <button @click="showNewModal = true" 
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-slate-50 bg-gradient-to-tr from-orange-400 to-orange-300 transition-colors duration-200">
                            Create New Project
                        </button>
                    </div>
                @endforelse
            </div>

            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $sn = 1; ?>
                        @forelse ($projects as $project)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $sn++ }}
                                </td>
                                <td class="px-6 py-4">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $project->title }}</div>
                                        <div class="text-sm text-gray-500 truncate max-w-md">{{ $project->description }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($project->status == 'Completed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $project->status }}
                                        </span>
                                    @elseif($project->status == 'Pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">
                                            {{ $project->status }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                            {{ $project->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <button @click="showEditModal = true;projectChoosen = {id : '{{$project->id}}', title:'{{$project->title}}', description:'{{$project->description}}'}" 
                                                class="inline-flex items-center px-3 py-1.5 border border-blue-500 rounded-md text-xs font-medium
                                                       text-blue-700 bg-slate-50 active:bg-blue-500 transition-colors duration-200">
                                            Edit
                                        </button>
                                        <button @click="showDeleteModal = true;projectChoosen = {id : '{{$project->id}}', title:'{{$project->title}}', description:'{{$project->description}}'}" 
                                                class="inline-flex items-center px-3 py-1.5 border border-red-300 rounded-md text-xs font-medium
                                                      text-red-700 bg-red-300 hover:bg-red-400 hover:border-transparent hover:text-slate-50 active:scale-95 transition duration-200">
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <!-- Icon hapa -->
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">No projects found</h3>
                                    <p class="text-gray-600 mb-6">Get started by creating your first project</p>
                                    <button @click="showNewModal = true" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-slate-50 bg-gradient-to-tr from-orange-400 to-orange-300 transition-colors duration-200">
                                        Create New Project
                                    </button>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-4 sm:px-6 py-4">
                {{ $projects->links()}}
            </div>
        </div>

        <!-- New Project Modal -->
        <div x-show="showNewModal" 
             x-cloak 
             class="fixed inset-0 z-40 overflow-y-auto p-4 sm:p-0"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-0 sm:px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity backdrop-blur-xs bg-opacity-75" 
                     @click="showNewModal = false"></div>

                <div class="inline-block relative w-full max-w-lg p-4 sm:p-6 my-4 sm:my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-medium leading-6 text-gray-900">Create New Project</h3>
                        <button @click="showNewModal = false" 
                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1">
                            <x-heroicon-s-x-mark class="w-6 h-6 text-gray-700"/>
                        </button>
                    </div>

                    <form action="{{ route('create-project') }}" method="post" class="mt-4 sm:mt-6 space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Title</label>
                            <input type="text" name="project_title" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent" 
                                   placeholder="Enter project title">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea rows="4" name="project_description"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent" 
                                      placeholder="Enter project description"></textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                            <button @click="showNewModal = false" 
                                    type="button" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors duration-200 order-2 sm:order-1">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 text-sm font-medium text-white bg-gradient-to-tr from-orange-400 to-orange-300 border border-transparent rounded-md transition-colors duration-200 order-1 sm:order-2">
                                Create Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Project Modal -->
        <div x-show="showEditModal" 
             x-cloak 
             class="fixed inset-0 z-40 overflow-y-auto p-4 sm:p-0"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-0 sm:px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity backdrop-blur-xs bg-opacity-75" 
                     @click="showEditModal = false"></div>

                <div class="inline-block relative w-full max-w-lg p-4 sm:p-6 my-4 sm:my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-medium leading-6 text-gray-900">Edit Project</h3>
                        <button @click="showEditModal = false" 
                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1">
                            <x-heroicon-s-x-mark class="w-6 h-6 text-gray-700"/>
                        </button>
                    </div>

                    <form action="{{ route('edit-project') }}" method="post" class="mt-4 sm:mt-6 space-y-4">
                        @csrf
                        <div>
                            <input type="text" name="project_id" hidden x-model="projectChoosen.id">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Title</label>
                            <input type="text" 
                                    name="project_title"
                                   x-model="projectChoosen.title"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea rows="4" 
                                      name="project_description"
                                      x-model="projectChoosen.description"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </textarea>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                            <button @click="showEditModal = false" 
                                    type="button" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none transition-colors duration-200 order-2 sm:order-1">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="px-4 py-2 text-sm font-medium text-white bg-orange-600 border border-transparent rounded-md hover:bg-orange-700 focus:outline-none transition-colors duration-200 order-1 sm:order-2">
                                Update Project
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div x-show="showDeleteModal" 
             x-cloak 
             class="fixed inset-0 z-40 overflow-y-auto p-4 sm:p-0"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0">
            <div class="flex items-center justify-center min-h-screen px-0 sm:px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 transition-opacity backdrop-blur-xs bg-opacity-75" 
                     @click="showDeleteModal = false"></div>

                <div class="inline-block relative w-full max-w-md p-4 sm:p-6 my-4 sm:my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    
                    <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                        <h3 class="text-base sm:text-lg font-medium leading-6 text-gray-900">Delete Project</h3>
                        <button @click="showDeleteModal = false" 
                                class="text-gray-400 hover:text-gray-600 transition-colors duration-200 p-1">
                            <x-heroicon-s-x-mark class="w-6 h-6 text-gray-700"/>
                        </button>
                    </div>

                    <div class="mt-4 sm:mt-6">
                            <div class="flex justify-center">
                                <x-heroicon-o-exclamation-circle class="w-12 h-12 text-red-700"/>
                            </div>
                        <h4 class="text-base sm:text-lg font-medium text-gray-900 text-center mb-2">Are you sure?</h4>
                        <p class="text-sm text-gray-600 text-center mb-4 sm:mb-6">
                            You are about to delete "<span x-text="projectChoosen.title" class="font-medium"></span>". 
                            This action cannot be undone.
                        </p>
                        
                        <div class="flex flex-col sm:flex-row justify-center gap-3">
                            <button @click="showDeleteModal = false" 
                                    type="button" 
                                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition-colors duration-200 order-2 sm:order-1">
                                Cancel
                            </button>
                            <form action="{{ route('delete-project') }}" method="post" class="order-1 sm:order-2">
                                @csrf
                                <input type="text" name="project_id" x-model="projectChoosen.id" hidden>
                                <button type="submit" 
                                    class="w-full sm:w-auto px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 transition-colors duration-200">
                                    Delete Project
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
        
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }
    </style>
</x-userLayout>