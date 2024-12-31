<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    {{-- @livewire('chat.chat-list') --}}

    <div class="sm:fixed h-full  flex border bg-white lg:shadow-lg overflow-hidden inset-0 top-28 lg:top-16 lg:inset-x-2 m-auto lg:h-[90%] rounded-lg">
        <div class="relative hidden md:block w-full md:w-[320px] xl:w-[400px] overflow-y-auto shrink-0 h-full border">
            @livewire('sidebar')
        </div>
        <div class=" w-full border-l h-full relative overflow-y-auto" style="contain: content">
            <div class="m-auto text-center justify-content flex flex-col gap-3">
                
                <header class="px-3 z-10 bg-white sticky top-0 w-full py-2">
                    <div class="border-b justify-between flex items-center pb-2">
                        <div class="flex items-center gap-2">
                        </div>
                        <div class="flex items-center gap-2">
                            {{-- <x-avatar class="h-6 w-6 lg:w-9 lg:h-9" src="{{ asset('profile_pic/' . Auth::user()->profilePic ) }}"/> --}}
                                @if (Auth::user()->profilePic == "")
                                <x-avatar/>
                                @else
                                <x-avatar  src="{{ asset('profile_pic/' .  Auth::user()->profilePic) }}" />
                                @endif
                            {{-- <x-avatar/> --}}
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="w-7 h-7" viewBox="0 0 16 16">
                                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                            </svg> --}}
                        </div>
                    </div>
                    
                </header>
                <div class="font-medium flex text-lg">
                    {{-- boxes --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full max-w-3xl mx-auto">
                        <!-- Chat with Coursemates Card -->
                        <div 
                            class="bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer h-64  w-96 mx-auto">
                            <a href="{{ route('chat.index') }}" class="block h-full p-6">
                                <div class="flex flex-col justify-center items-center h-full">
                                    <div class="bg-white text-blue-500 p-3 rounded-full">
                                        <i class="fa-solid fa-comments fa-2x"></i>
                                    </div>
                                    <h2 class="text-xl font-semibold mt-4">Chats with Coursemates</h2>
                                    <p class="mt-2 text-sm text-blue-200 text-center">
                                        Stay connected with your classmates. View and manage all your conversations in one place.
                                    </p>
                                </div>
                            </a>
                        </div>

                        <!-- Course Classrooms Card -->
                        <div 
                            class="bg-gradient-to-br from-green-500 to-green-700 text-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 cursor-pointer h-64 w-96 mx-auto">
                            <a href="{{ route('classroom') }}" class="block h-full p-6">
                                <div class="flex flex-col justify-center items-center h-full">
                                    <div class="bg-white text-green-500 p-3 rounded-full">
                                        <i class="fa-solid fa-chalkboard-teacher fa-2x"></i>
                                    </div>
                                    <h2 class="text-xl font-semibold mt-4">Course Classrooms</h2>
                                    <p class="mt-2 text-sm text-green-200 text-center">
                                        Access your course classrooms, check resources, and join discussions.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- end of boxes --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
