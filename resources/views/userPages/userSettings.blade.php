<x-userLayout>
    <div class="min-h-screen flex justify-center items-center p-4" x-data="{enableEdit: false}">
        <div class="bg-[#FDFDFD] rounded-2xl shadow-lg border border-gray-200 w-full max-w-md sm:max-w-lg lg:max-w-2xl relative">
            <!-- User Avatar -->
            <div class="flex justify-center -mt-12 mb-6">
                <div class="w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 bg-gray-400 rounded-full border-4 border-white shadow-lg flex items-center justify-center">
                    <span class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800">
                        {{ substr(Auth()->user()->name, 0, 1) }}
                    </span>
                </div>
            </div>

            <div class="p-6 sm:p-8 pt-0">
                <!-- User Information Display -->
                <div class="space-y-4 sm:space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                        <p class="text-sm sm:text-lg font-semibold min-w-0 sm:min-w-[100px]">Username:</p>
                        <span class="font-light text-sm sm:text-lg text-gray-700 break-words">{{Auth()->user()->name}}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                        <p class="text-sm sm:text-lg font-semibold min-w-0 sm:min-w-[100px]">Email:</p>
                        <span class="font-light text-sm sm:text-lg text-gray-700 break-all">{{Auth()->user()->email}}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                        <p class="text-sm sm:text-lg font-semibold min-w-0 sm:min-w-[100px]">Phone:</p>
                        <span class="font-light text-sm sm:text-lg text-gray-700 break-words">{{Auth()->user()->phone}}</span>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-4">
                        <p class="text-sm sm:text-lg font-semibold min-w-0 sm:min-w-[100px]">Password:</p>
                        <input type="password" 
                               value="{{Auth()->user()->password ?? 'Pass'}}" 
                               disabled 
                               class="bg-gray-100 border border-gray-300 rounded px-3 py-1 text-sm sm:text-base flex-1 max-w-xs">
                    </div>
                </div>

                <div class="flex justify-center mt-6 sm:mt-8">
                    <button type="button" 
                            class="bg-slate-50 border-2 border-orange-500 px-6 py-2 rounded-xl text-orange-600 hover:bg-orange-50 transition-colors duration-200 text-sm sm:text-base"
                            @click="enableEdit = true">
                            <x-heroicon-o-pencil class="w-6 h-6 text-orange-700"/>
                        
                    </button>
                </div>

                
                <div class="mt-6 sm:mt-8" x-show="enableEdit" x-cloak x-transition.duration.500ms>
                    <form action="{{ route('updateCredentials') }}" class="space-y-4 sm:space-y-6" method="post">
                        @csrf
                        <input type="text" name="user_id" value="{{Auth()->user()->id}}" hidden>
                        
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Username:</label>
                            <input type="text" 
                                   name="username" 
                                   class="w-full border-2 border-gray-500 rounded-lg h-10 px-4 text-sm sm:text-base focus:outline-none focus:border-orange-400 transition-colors duration-200" 
                                   value="{{Auth()->user()->name}}">
                            @error('username')
                                <p class="text-xs text-red-500 italic">{{ $message }}</p>                            
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Email:</label>
                            <input type="email" 
                                   name="user_email" 
                                   class="w-full border-2 border-gray-500 rounded-lg h-10 px-4 text-sm sm:text-base focus:outline-none focus:border-orange-400 transition-colors duration-200" 
                                   value="{{Auth()->user()->email}}">
                            @error('user_email')
                                <p class="text-xs text-red-500 italic">{{ $message }}</p>                            
                            @enderror                        
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Phone:</label>
                            <input type="text" 
                                   name="phone_number" 
                                   class="w-full border-2 border-gray-500 rounded-lg h-10 px-4 text-sm sm:text-base focus:outline-none focus:border-orange-400 transition-colors duration-200" 
                                   value="{{Auth()->user()->phone}}">
                            @error('phone_number')
                                <p class="text-xs text-red-500 italic">{{ $message }}</p>                            
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">New Password:</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <input type="password" 
                                           name="password" 
                                           class="w-full border-2 border-gray-500 rounded-lg h-10 px-4 text-sm sm:text-base focus:outline-none focus:border-orange-400 transition-colors duration-200" 
                                           placeholder="Enter new password">
                                    @error('password')
                                        <p class="text-xs text-red-500 italic mt-1">{{ $message }}</p>                            
                                    @enderror
                                </div>

                                <div>
                                    <input type="password" 
                                           name="password_confirmation" 
                                           class="w-full border-2 border-gray-500 rounded-lg h-10 px-4 text-sm sm:text-base focus:outline-none focus:border-orange-400 transition-colors duration-200" 
                                           placeholder="Confirm new password">
                                    @error('password_confirmation')
                                        <p class="text-xs text-red-500 italic mt-1">{{ $message }}</p>                            
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row justify-between gap-3 pt-4">
                            <button type="button" 
                                    @click="enableEdit = false" 
                                    class="order-2 sm:order-1 border-2 border-gray-500 px-6 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200 text-sm sm:text-base">
                                Cancel
                            </button>
                            <button type="submit" 
                                    class="order-1 sm:order-2 bg-gradient-to-tr from-orange-500 to-orange-400 px-8 py-2 rounded-xl text-slate-50 active:scale-95 transition duration-300 text-sm sm:text-base">
                                
                                <x-heroicon-s-check class="w-6 h-6 text-slate-50"/>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-userLayout>